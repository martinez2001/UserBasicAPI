<?php

namespace App\Application\UserDataSource;

use App\Domain\User;

Interface UserDataSource
{
    public function findByEmail(string $email): User;
    public function getUsersList(): array;
    public function getUserDataById(string $userId): array;
}
