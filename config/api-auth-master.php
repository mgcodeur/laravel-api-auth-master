<?php

return [
    'use' => [
        'jobs' => true, // don't forget to run php artisan queue:table and php artisan migrate and php artisan queue:work if you want to use jobs
    ],

    'auth' => [
        'model' => 'App\Models\User', // model used for authentication, you can replace it, you can use User::class syntax
        'table' => 'users',
    ],

    'otp' => [
        'length' => 6, // length of the otp code
        'expiration' => 3600, // expiration time of the otp code in seconds
        'attempts' => 3, // number of attempts before the otp code is expired
        'default_driver' => 'email', // default driver used to send the otp code (email, sms, ...)
        'email' => [
            'subject' => 'Your otp code', // subject of the email
            'template' => 'mg-auth::emails.otp', // view of the email
        ],
    ],

    'token' => [
        'name' => 'user  access token', // name of the token
        'expiration' => 3600, // expiration time of the token in seconds
    ],
];
