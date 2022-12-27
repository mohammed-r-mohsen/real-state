<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'google' => [
        'client_id' => '1077075259958-fjoeli0vci7aukn61eo28pp2nkc7h53a.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' =>'https://no-comission.com/google_callback',
    ],
    'facebook' => [
        'client_id' => '686386806210028',
        'client_secret' => '7e99da6f4f068f128fd286a09b4d327f',
        'redirect' =>'https://no-comission.com/facebook_callback',
    ],
    

];
