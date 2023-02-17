<?php

use App\Models\User;

return [
    'use' => [
        'jobs' => true, // don't forget to run php artisan queue:table and php artisan migrate and php artisan queue:work if you want to use jobs
    ],

    'auth' => [
        'model' => User::class, // model used for authentication
        'table' => 'users',
    ],
];
