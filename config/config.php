<?php

declare(strict_types=1);

return [
    'app' => [
        'name'      => $_ENV['APP_NAME']    ?? 'NimbusDocs',
        'env'       => $_ENV['APP_ENV']     ?? 'local',
        'debug'     => $_ENV['APP_DEBUG']   ?? 'false',
        'url'       => $_ENV['APP_URL']     ?? 'https://nimbusdocs.local/',
        'timezone'  => $_ENV['APP_TIMEZONE'] ?? 'America/Sao_Paulo',
        'secret'    => $_ENV['APP_SECRET']  ?? '',
        'session'   => $_ENV['SESSION_NAME'] ?? 'nimbusdocs_session',
    ],

    'db' => [
        'driver'   => $_ENV['DB_CONNECTION'] ?? 'mysql',
        'host'     => $_ENV['DB_HOST']       ?? '127.0.0.1',
        'port'     => (int)($_ENV['DB_PORT'] ?? 3306),
        'database' => $_ENV['DB_DATABASE']   ?? 'nimbusdocs',
        'username' => $_ENV['DB_USERNAME']   ?? 'root',
        'password' => $_ENV['DB_PASSWORD']   ?? '',
        'charset'  => 'utf8mb4',
        'options'  => [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ],
    ],

    'log' => [
        'channel' => $_ENV['LOG_CHANNEL'] ?? 'single',
        'path'    => $_ENV['LOG_PATH']    ?? 'storage/logs/nimbusdocs.log',
        'level'   => $_ENV['LOG_LEVEL']   ?? 'debug',
    ],

    'upload' => [
        'max_filesize_mb' => (int)($_ENV['UPLOAD_MAX_FILESIZE_MB'] ?? 100),
        'allowed_mime'    => array_map('trim', explode(',', $_ENV['UPLOAD_ALLOWED_MIME'] ?? '')),
        'storage_path'    => $_ENV['UPLOAD_STORAGE_PATH'] ?? 'storage/uploads',
    ],
];
