<?php

return [
    'use' => [
        'jobs' => true, // don't forget to run php artisan queue:table and php artisan migrate and php artisan queue:work if you want to use jobs
    ],

    'auth' => [
        'model' => 'App\Models\User', // model used for authentication, you can replace it
        'table' => 'users',
    ],
];
