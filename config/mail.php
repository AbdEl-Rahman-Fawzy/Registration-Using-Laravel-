<?php
return [

    'default' => env('MAIL_MAILER', 'smtp'),

    'mailers' => [
        'smtp' => [
            'transport' => 'smtp',
            'url' => env('MAIL_URL'),
            'host' => env('MAIL_HOST', '127.0.0.1'),
            'port' => env('MAIL_PORT', 2525),
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN'),
        ],
        // other mailers...
    ],

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'hazemnasser3050@gmail.com'),
        'name' => env('MAIL_FROM_NAME', 'Hazem Nasser'),
    ],

    // other settings...
];
