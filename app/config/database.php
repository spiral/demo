<?php

declare(strict_types=1);

use Spiral\Database\Driver;

return [
    'default'   => 'default',
    'databases' => [
        'default' => ['driver' => 'default'],
    ],
    'drivers'   => [
        'default' => [
            'driver'     => Driver\MySQL\MySQLDriver::class,
            'connection' => sprintf('mysql:host=%s;dbname=%s', env('DB_HOST'), env('DB_NAME')),
            'username'   => env('DB_USER'),
            'password'   => env('DB_PASSWORD'),
        ],
    ]
];
