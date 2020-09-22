<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function getUserById(int $userId) : array;
    public function getUserIdByEmail(string $email): int;
    public function store(string $login, string $email, string $password): void;
}
