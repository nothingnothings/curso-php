<?php declare(strict_types=1);

namespace App\Services;




class HashService
{
    public function __construct() {}

    public function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    }

    public function verify(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}