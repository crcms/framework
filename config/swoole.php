<?php

return [
    'servers' => [
        [
            'drive' => 'http',
            'host' => '0.0.0.0',
            'port' => 22,
            'mode' => SWOOLE_PROCESS,
            'type' => SWOOLE_SOCK_TCP,
        ],
    ],

    'drives' => [
        'http' => \CrCms\Foundation\Swoole\Server\Http\Server::class
    ],

    'notify' => [
        'targets' => [
            base_path('modules'),
            base_path('resources'),
        ],
        'monitor' => false,
        'log_path' => storage_path('logs/reload.log')
    ],
    'error_log' => storage_path('logs/error_%s.log'),
    'process_prefix' => 'swoole_',
    'pid_file' => storage_path('swoole.pid'),
    'request_log' => storage_path('logs/request-%s.log'),
];