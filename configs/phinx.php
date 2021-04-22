<?php

require './vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createImmutable('./');
$dotenv->load();

return
[
    'paths' => [
        'migrations' => './database/migrations',
        'seeds' => './database/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_database' => env('DB_ENV'),
        'production' => [
            'adapter' => env('DB_CONNECTION'),
            'host' => env('DB_HOST'),
            'name' => env('DB_DATABASE'),
            'user' => env('DB_USERNAME'),
            'pass' => env('DB_PASSWORD'),
            'port' => env('DB_PORT', 3306),
            'charset' => env('DB_CHARSET', 'utf8'),
            'table_prefix' => ''
        ],
        'development' => [
            'adapter' => env('DB_CONNECTION'),
            'host' => env('DB_HOST'),
            'name' => env('DB_DATABASE'),
            'user' => env('DB_USERNAME'),
            'pass' => env('DB_PASSWORD'),
            'port' => env('DB_PORT', 3306),
            'charset' => env('DB_CHARSET', 'utf8'),
            'table_prefix' => ''
        ]
    ],
    'version_order' => 'creation'
];