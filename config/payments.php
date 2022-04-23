<?php

return [
    'paypal' => [
        'mode'          => env('PAYPAL_MODE', 'sandbox'),
        'client_id'     => env('PAYPAL_CLIENT_ID'),
        'client_secret' => env('PAYPAL_SECRET'),


        'payment_action' => env('PAYPAL_PAYMENT_ACTION', 'Sale'), // Can only be 'Sale', 'Authorization' or 'Order'
        'currency'       => env('PAYPAL_CURRENCY', 'USD'),
        'notify_url'     => env('PAYPAL_NOTIFY_URL', ''), // Change this accordingly for your application.
        'locale'         => env('PAYPAL_LOCALE', 'en_US'),
        // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
        'validate_ssl'   => env('PAYPAL_VALIDATE_SSL', true), // Validate SSL when creating api client.
    ],

    'razorpay' => [
        'key'    => env('RAZOR_KEY'),
        'secret' => env('RAZOR_SECRET'),
    ],
];
