<?php
require_once __DIR__.'/vendor/autoload.php';

$config = M1\Env\Parser::parse(file_get_contents(__DIR__ . '/.env'));

return [
    'paths' => [
        'migrations' => 'database/migrations',
        'seeds' => 'database/seeds',
    ],
    'migration_base_class' => '\App\Migration\Migration',
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_database' => 'production',
        'production' => [
            'adapter' => $config['DB_CONNECTION'] ?? 'mysql',
            'host' => $config['DB_HOST'] ?? '',
            'name' => $config['DB_NAME'] ?? '',
            'user' => $config['DB_USER'] ?? '',
            'pass' => $config['DB_PASSWORD'] ?? '',
            'port' => $config['DB_PORT'] ?? 3306,
            'charset' => 'utf8',
        ],
        'development' => [
            'adapter' => $config['DB_CONNECTION'] ?? 'mysql',
            'host' => 'localhost',
            'name' => 'development_db',
            'user' => $config['DB_USER'] ?? '',
            'pass' => $config['DB_PASSWORD'] ?? '',
            'port' => $config['DB_PORT'] ?? 3306,
            'charset' => 'utf8',
        ],
        'testing' => [
            'adapter' => $config['DB_CONNECTION'] ?? 'mysql',
            'host' => 'localhost',
            'name' => 'testing_db',
            'user' => $config['DB_USER'] ?? '',
            'pass' => $config['DB_PASSWORD'] ?? '',
            'port' => $config['DB_PORT'] ?? 3306,
            'charset' => 'utf8',
        ]
    ],
    'version_order' => 'creation'
];
