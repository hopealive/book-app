<?php

namespace App;

use Illuminate\Database\Capsule\Manager as Capsule;
use Phinx\Migration\AbstractMigration;
use M1\Env\Parser;

class Migration extends AbstractMigration {
    /** @var \Illuminate\Database\Capsule\Manager $capsule */
    public $capsule;
    /** @var \Illuminate\Database\Schema\Builder $capsule */
    public $schema;

    public function init()
    {
        $config = Parser::parse(file_get_contents(__DIR__ . '/../.env'));

        $this->capsule = new Capsule;
        $this->capsule->addConnection([
            'driver' => $config['DB_CONNECTION'] ?? 'mysql',
            'host' => $config['DB_HOST'] ?? '',
            'database' => $config['DB_NAME'] ?? '',
            'username' => $config['DB_USER'] ?? '',
            'password' => $config['DB_PASSWORD'] ?? '',
            'port' => $config['DB_PORT'] ?? 3306,
            'charset'   => 'utf8',
            'collation' => 'utf8_general_ci',
        ]);

        $this->capsule->bootEloquent();
        $this->capsule->setAsGlobal();
        $this->schema = $this->capsule->schema();
    }
}