<?php

namespace App\Middleware;

use App\Repositories\UserRepository;
use App\Exceptions\UserException;
use Exception;

class Auth
{

    public function login()
    {
        $user = [];
        $repository = new UserRepository();

        try {
            $email = filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL);
            if (empty($email)) throw new UserException('Empty email');

            $password = filter_var(trim($_POST["password"]), FILTER_SANITIZE_STRING);
            if (empty($password)) throw new UserException('Empty password');
            if (strlen($password) < 8) throw new UserException('Password must be at least 8 symbols');

            $userId = $repository->getUserIdByEmail($email);
            if (empty($userId)) throw new UserException('User with this email does not exists');

            $user = $repository->getUserById($userId);
            if (empty($user) || empty($user['password'])) throw new UserException('User with this email does not exists');

            if (!password_verify($password, $user['password'])) {
                throw new UserException('Wrong password');
            }
            $_SESSION['userId'] = $userId;
        } catch (UserException $e) {
            $_SESSION['errors'] = $e->getMessage();
        }
        return $user;
    }

    public function logout(): void
    {
        unset($_SESSION['userId']);
    }
}
