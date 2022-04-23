<?php

namespace App\Repositories;

use App\Models\Sms;
use App\Models\User;
use Auth;
use Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Rest\Client;

/**
 * Class SmsRepository
 */
class SmsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user',
        'message',
    ];

    /**
     * @return array|string[]
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * @return string
     */
    public function model()
    {
        return Sms::class;
    }

    /**
     * @param $input
     */
    public function store($input)
    {
        if (! isset($input['number'])) {
            $userMobile = User::whereIn('id', $input['send_to'])->pluck('phone', 'id');
            foreach ($userMobile as $key => $phone) {
                $this->sendSMS($key, null, $phone, $input['message']);
            }
        } else {
            $this->sendSMS(null, $input['prefix_code'], $input['phone'], $input['message']);
        }
    }

    /**
     * @param $sendTo
     * @param $regionCode
     * @param $phone
     * @param $message
     *
     * @throws ConfigurationException
     */
    public function sendSMS($sendTo, $regionCode, $phone, $message)
    {
        $sid = config('twilio.sid');
        $token = config('twilio.token');
        $client = new Client($sid, $token);

        try {
            $sms = Sms::create([
                'send_to'      => $sendTo,
                'region_code'  => $regionCode,
                'phone_number' => $phone,
                'message'      => $message,
                'send_by'      => Auth::user()->id,
            ]);

            $client->messages->create(
                substr($phone, 0, 1) == '+' ? $phone : '+'.$sms->region_code.$sms->phone_number,
                [
                    'from' => config('twilio.from_number'),
                    'body' => $message,
                ]
            );
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
