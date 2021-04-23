<?php

return [
    'mysql' => [
        'host' => env('DB_HOST') . ':' . env('DB_PORT'),
        'username' => env('DB_USERNAME'),
        'password' => env('DB_PASSWORD'),
        'database' => env('DB_DATABASE'),
    ],
    'auth' => [
        'model' => App\Models\User::class
    ],
    'providers' => [
        \App\Providers\RouteProvider::class
    ],
    'middlewares' => [
        'auth' => \App\Http\Middlewares\AuthMiddleware::class,
        'can' => \App\Http\Middlewares\CanMiddleware::class,
    ]
];