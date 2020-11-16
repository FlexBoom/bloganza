<?php declare(strict_types=1);

return [
    'PDO' => [
        'host' => '127.0.0.1',
        'dbname' => '',
        'user' => '',
        'password' => '',
        'charset' => 'utf8mb4',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    ]
];
