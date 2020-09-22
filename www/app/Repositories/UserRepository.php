<?php
namespace App\Repositories;

use App\Lib\Storage\Redis;

class UserRepository implements UserRepositoryInterface
{
    private $_client;

    public function __construct()
    {
        $this->_client = (new Redis())->getClient();
    }

    public function getUserById(int $userId) : array
    {
        return $this->_client->hgetall('user:'.$userId);
    }

    public function getUserIdByEmail(string $email) : int
    {
        $id = null;
        foreach ( (new Redis())->getIterator('users') as $field => $value) {
            if($value !== $email) continue;
            if( (int) $field) return (int) $field;
        }
        return (int) $id;
    }

    public function store(string $login, string $email, string $password): void
    {
        $counter = $this->_client->get('count_users');
        if(empty($counter)) $this->_client->set('count_users', 0);

        $userData = [
            'login' => $login,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
        ];

        $this->_client->transaction(function ($tx) use ($email, $userData) {
            $id = $this->_client->executeRaw(['INCR', 'count_users']);
            $tx->hmset('users', [ $id => $email ] );
            $tx->hmset('user:'.$id, $userData);
        });
    }
}
