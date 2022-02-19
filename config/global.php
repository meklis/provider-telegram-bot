<?php

return [
    'telegram' => [
        'api_key' => env('TELEGRAM_API_KEY'),
        'username' => env('TELEGRAM_BOT_USERNAME'),
    ],
    'mysql' => [
        'host'     => env('DB_HOST'),
        'port'     => env('DB_PORT'), // optional
        'user'     => env('DB_USERNAME'),
        'password' => env('DB_PASSWORD'),
        'database' => env('DB_DATABASE'),
    ]
];