<?php

declare(strict_types=1);

use Cycle\Database\Config;

return [
    'default'   => 'default',
    'databases' => [
        'default' => ['driver' => 'default'],
    ],
    'drivers'   => [
        'default' => new Config\MySQLDriverConfig(
            connection: new Config\MySQL\TcpConnectionConfig(
                database: env('DB_NAME'),
                host: env('DB_HOST'),
                port: (int) env('DB_PORT', 3306),
                user: env('DB_USER'),
                password: env('DB_PASSWORD')
            ),
            queryCache: true
        ),
    ]
];
