<?php

namespace App\Console;

use App\Exceptions\UserException;
use M1\Env\Parser;
use Predis\Client as Redis;
use Predis\Collection\Iterator;

class AddUser
{
    private $_client,
        $_login,
        $_email,
        $_password;

    public function __construct(string $login, string $email, string $password)
    {
        $this->_login = $login;
        $this->_email = $email;
        $this->_password = $password;

        $config = Parser::parse(file_get_contents(__DIR__ . '/../../.env'));
        $this->_client = new Redis([
            'scheme' => $config['REDIS_SCHEME'] ?? 'tcp',
            'host'   => $config['REDIS_HOST'] ?? '127.0.0.1',
            'port'   => $config['REDIS_POST'] ?? 6379,
        ]);
    }

    public function getUserIdByEmail() : int
    {
        $id = null;
        foreach (new Iterator\HashKey($this->_client, 'users') as $field => $value) {
            if($value !== $this->_email) continue;
            if( (int) $field) return (int) $field;
        }
        return (int) $id;
    }

    public function register()
    {
        $id = $this->getUserIdByEmail();
        if($id) throw new UserException('This email already exists');

        $counter = $this->_client->get('count_users');
        if(empty($counter)) $this->_client->set('count_users', 0);

        $userData = [
            'login' => $this->_login,
            'email' => $this->_email,
            'password' => password_hash($this->_password, PASSWORD_BCRYPT),
        ];

        $this->_client->transaction(function ($tx) use ($userData) {
            $id = $this->_client->executeRaw(['INCR', 'count_users']);
            $tx->hmset('users', [ $id => $this->_email ] );
            $tx->hmset('user:'.$id, $userData);
        });
    }
}
