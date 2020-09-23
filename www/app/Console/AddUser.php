<?php

namespace App\Console;

use App\Repositories\UserRepository;
use App\Exceptions\UserException;

class AddUser
{
    private $_login,
        $_email,
        $_password;

    public function __construct(string $login, string $email, string $password)
    {
        $this->_login = $login;
        $this->_email = $email;
        $this->_password = $password;
    }

    /**
     * Store new user
     */
    public function handle()
    {
        $repository = new UserRepository;
        $id = $repository->getUserIdByEmail($this->_email);
        if($id) throw new UserException('This email already exists');
        if(strlen($this->_password) <= 8) throw new UserException('Password must be at least 8 symbols');
        $repository->store($this->_login, $this->_email, $this->_password);
        echo "User ".$this->_login . " successfully stored";
    }
}
