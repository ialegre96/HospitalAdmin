<?php

namespace App\Repositories;

use App\Models\LiveConsultation;
use App\Models\User;
use GuzzleHttp\Client;
use Log;

/**
 * Class ZoomRepository
 */
class ZoomRepository
{
    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;

    public $client;
    public $jwt;
    public $headers;

    public function __construct($createdBy = null)
    {
        $createdByName = '';
        if ($createdBy != null) {
            $createdByName = User::whereId($createdBy)->first()->roles->pluck('name')->first();
        }
        $this->client = new Client();
        $this->jwt = $this->generateZoomToken(['createdByName' => $createdByName, 'createdById' => $createdBy]);
        $this->headers = [
            'Authorization' => 'Bearer '.$this->jwt,
            'Content-Type'  => 'application/json',
            'Accept'        => 'application/json',
        ];
    }

    public function generateZoomToken($data = [])
    {
        $meetingOwner = (isset($data['meeting_owner'])) ? $data['meeting_owner'] : null;
        $userZoomCredential = \App\Models\UserZoomCredential::where('user_id', $meetingOwner)->first();

        if ($userZoomCredential || (isset($data['createdByName']) && $data['createdByName'] == 'Doctor')) {
            if (isset($data['createdById'])) {
                $userZoomCredential = \App\Models\UserZoomCredential::where('user_id', $data['createdById'])->first();
            }
            $key = $userZoomCredential->zoom_api_key;
            $secret = $userZoomCredential->zoom_api_secret;
        } else {
            $key = config('app.zoom_api_key');
            $secret = config('app.zoom_api_secret');
        }
        $payload = [
            'iss' => $key,
            'exp' => strtotime('+1 minute'),
        ];

        return \Firebase\JWT\JWT::encode($payload, $secret, 'HS256');
    }

    private function retrieveZoomUrl()
    {
        return config('app.zoom_api_url');
    }

    public function zoomGet(string $path, array $data = [])
    {
        $url = $this->retrieveZoomUrl();
        $this->jwt = $this->generateZoomToken($data);
        $body = [
            'headers' => $this->headers,
            'body'    => json_encode($data),
        ];

        return $this->client->get($url.$path, $body);
    }

    public function zoomPost(string $path, array $data = [])
    {
        $url = $this->retrieveZoomUrl();

        $body = [
            'headers' => $this->headers,
            'body'    => json_encode($data),
        ];

        return $this->client->post($url.$path, $body);
    }

    public function zoomPatch(string $path, array $data = [])
    {
        $url = $this->retrieveZoomUrl();

        $body = [
            'headers' => $this->headers,
            'body'    => json_encode($data),
        ];

        return $this->client->patch($url.$path, $body);
    }

    public function zoomDelete(string $path, array $data = [])
    {
        $url = $this->retrieveZoomUrl();
        $body = [
            'headers' => $this->headers,
            'body'    => json_encode($data),
        ];

        return $this->client->delete($url.$path, $body);
    }

    public function toZoomTimeFormat(string $dateTime)
    {
        try {
            $date = new \DateTime($dateTime);

            return $date->format('Y-m-d\TH:i:s');
        } catch (\Exception $e) {
            Log::error('ZoomJWT->toZoomTimeFormat : '.$e->getMessage());

            return '';
        }
    }

    public function toUnixTimeStamp(string $dateTime, string $timezone)
    {
        try {
            $date = new \DateTime($dateTime, new \DateTimeZone($timezone));

            return $date->getTimestamp();
        } catch (\Exception $e) {
            Log::error('ZoomJWT->toUnixTimeStamp : '.$e->getMessage());

            return '';
        }
    }

    public function create($data)
    {
        $path = 'users/me/meetings';
        $response = $this->zoomPost($path, [
            'topic'      => $data['consultation_title'],
            'type'       => self::MEETING_TYPE_SCHEDULE,
            'start_time' => $this->toZoomTimeFormat($data['consultation_date']),
            'duration'   => $data['consultation_duration_minutes'],
            'agenda'     => (! empty($data['description'])) ? $data['description'] : null,
            'timezone'   => 'Asia/Kolkata',
            'settings'   => [
                'host_video'        => ($data['host_video'] == LiveConsultation::HOST_ENABLE) ? true : false,
                'participant_video' => ($data['participant_video'] == LiveConsultation::CLIENT_ENABLE) ? true : false,
                'waiting_room'      => true,
            ],
        ]);

        return [
            'success' => $response->getStatusCode() === 201,
            'data'    => json_decode($response->getBody(), true),
        ];
    }

    public function update($id, $data)
    {
        $path = 'meetings/'.$id;
        $response = $this->zoomPatch($path, [
            'topic'      => $data['consultation_title'],
            'type'       => self::MEETING_TYPE_SCHEDULE,
            'start_time' => $this->toZoomTimeFormat($data['consultation_date']),
            'duration'   => $data['consultation_duration_minutes'],
            'agenda'     => (! empty($data['description'])) ? $data['description'] : null,
            'timezone'   => 'Asia/Kolkata',
            'settings'   => [
                'host_video'        => ($data['host_video'] == LiveConsultation::HOST_ENABLE) ? true : false,
                'participant_video' => ($data['participant_video'] == LiveConsultation::CLIENT_ENABLE) ? true : false,
                'waiting_room'      => true,
            ],
        ]);

        return [
            'success' => $response->getStatusCode() === 204,
            'data'    => json_decode($response->getBody(), true),
        ];
    }

    public function get($id, $data = [])
    {
        $path = 'meetings/'.$id;
        $response = $this->zoomGet($path, $data);

        return [
            'success' => $response->getStatusCode() === 204,
            'data'    => json_decode($response->getBody(), true),
        ];
    }

    /**
     * @param  string  $id
     *
     * @return bool[]
     */
    public function delete($id)
    {
        $path = 'meetings/'.$id;
        $response = $this->zoomDelete($path);

        return [
            'success' => $response->getStatusCode() === 204,
        ];
    }
}
