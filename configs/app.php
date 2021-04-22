<?php

return [
    'mysql' => [
        'host' => env('DB_HOST') . ':' . env('DB_PORT'),
        'username' => env('DB_USERNAME'),
        'password' => env('DB_PASSWORD'),
        'database' => env('DB_DATABASE'),
    ]
];