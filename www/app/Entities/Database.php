<?php

namespace App\Entities;

use Illuminate\Database\Capsule\Manager as Capsule;
use Phinx\Migration\AbstractMigration;
use M1\Env\Parser;

class Database
{

    function __construct()
    {
        $config = Parser::parse(file_get_contents(__DIR__ . '/../../.env'));

        $capsule = new Capsule;
        $capsule->addConnection([
            'driver' => $config['DB_CONNECTION'] ?? 'mysql',
            'host' => $config['DB_HOST'] ?? '',
            'database' => $config['DB_NAME'] ?? '',
            'username' => $config['DB_USER'] ?? '',
            'password' => $config['DB_PASSWORD'] ?? '',
            'port' => $config['DB_PORT'] ?? 3306,
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);
        // Setup the Eloquent ORM…
        $capsule->bootEloquent();
    }
}
