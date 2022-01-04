<?php

declare(strict_types=1);

return [
    'modules' => [
        'Laminas\Cache',
        'Laminas\Form',
        'Laminas\Hydrator',
        'Laminas\Paginator',
        'Laminas\Router',
        'Laminas\Validator',
        'DoctrineModule',
        'DoctrineMongoODMModule',
    ],
    'module_listener_options' => [
        'config_glob_paths' => ['./tests/testing.config.php'],
        'module_paths' => ['../vendor'],
    ],
];
