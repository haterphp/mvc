<?php

$configs = [
    'mysql' => [
        'host' => getenv('DB_HOST') . ':' . getenv('DB_PORT'),
        'username' => getenv('DB_USERNAME'),
        'password' => getenv('DB_PASSWORD'),
        'database' => getenv('DB_DATABASE'),
    ]
];

return $configs;