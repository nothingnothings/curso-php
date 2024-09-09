<?php declare(strict_types=1);

namespace App\Services;

use App\Contracts\UserInterface;
use App\Contracts\UserProviderServiceInterface;
use App\DTOs\UserData;
use App\Entity\User;
use Doctrine\ORM\EntityManager;

class UserProviderService implements UserProviderServiceInterface
{
    public function __construct(private readonly EntityManager $entityManager) {}

    public function getById(int $userId): ?UserInterface
    {
        return $this->entityManager->find(User::class, $userId);
    }

    public function getByCredentials(array $credentials): ?UserInterface
    {
        return $this->entityManager->getRepository(User::class)->findOneBy(['email' => $credentials['email']]);
    }

    public function createUser(UserData $userData): UserInterface
    { 
        $user = new User();
        
        $user->setName($userData->name);
        $user->setEmail($userData->email);
        $user->setHashedPassword($userData->password);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }
}   