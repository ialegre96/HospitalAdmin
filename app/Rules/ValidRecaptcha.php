<?php

namespace App\Rules;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Validation\Rule;

class   ValidRecaptcha implements Rule
{
    /**
     * @param  string
     *
     * @param  mixed  $value
     *
     * @throws GuzzleException
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Validate ReCaptcha
        $client = new Client([
            'base_uri' => 'https://google.com/recaptcha/api/',
        ]);

        $response = $client->post('siteverify', [
            'query' => [
                'secret'   => config('app.recaptcha.secret'),
                'response' => $value,
            ],
        ]);

        return json_decode($response->getBody())->success;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'ReCaptcha verification failed.';
    }
}
