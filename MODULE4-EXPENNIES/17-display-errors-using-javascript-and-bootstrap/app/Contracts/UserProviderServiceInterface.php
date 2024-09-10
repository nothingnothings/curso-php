<?php declare(strict_types=1);

namespace App\Contracts;

use App\DTOs\UserData;

interface UserProviderServiceInterface
{
    public function getById(int $userId): ?UserInterface;

    public function getByCredentials(array $credentials): ?UserInterface;

    public function createUser(UserData $data): UserInterface;
}
