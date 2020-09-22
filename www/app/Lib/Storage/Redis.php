<?php
namespace App\Lib\Storage;

use M1\Env\Parser;
use Predis\Client;
use Predis\Collection\Iterator;

class Redis
{
    private $_client;

    public function __construct()
    {
        $config = Parser::parse(file_get_contents(__DIR__ . '/../../../.env'));
        $this->_client = new Client([
            'scheme' => $config['REDIS_SCHEME'] ?? 'tcp',
            'host'   => $config['REDIS_HOST'] ?? '127.0.0.1',
            'port'   => $config['REDIS_POST'] ?? 6379,
        ]);
    }

    public function getClient()
    {
        return $this->_client;
    }

    public function getIterator($key)
    {
        return new Iterator\HashKey($this->_client, $key);
    }
}