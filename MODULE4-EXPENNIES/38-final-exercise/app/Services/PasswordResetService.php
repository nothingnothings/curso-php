<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\EntityManagerServiceInterface;
use App\Entity\PasswordReset;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class PasswordResetService extends EntityManagerService
{



    public function __construct(private readonly EntityManagerServiceInterface $entityManagerService, private readonly HashService $hashService) {}



    // * Generates the 2FA code for the user
    public function generate(string $email): PasswordReset
    {

        $passwordReset = new PasswordReset();
        $token = bin2hex(random_bytes(32));

        $passwordReset->setEmail($email);
        $passwordReset->setExpiration(new \DateTime('+30 minutes'));
        $passwordReset->setToken($token);

        $this->entityManagerService->sync($passwordReset);

        return $passwordReset;
    }

    public function findByToken(string $token): ?PasswordReset
    {
        return $this->entityManagerService->getRepository(PasswordReset::class)
            ->createQueryBuilder('pr')
            ->select('pr')
            ->where('pr.token = :token')
            ->andWhere('pr.isActive = :active')
            ->andWhere('pr.expiration > :now')
            ->setParameters(
                [
                    'token' => $token,
                    'active' => 1,
                    'now' => new \DateTime(),
                ]
            )
            ->getQuery()
            ->getOneOrNullResult();
    }



    public function deactivateAllPasswordResets(string $email): void
    {

        $this->entityManagerService
            ->getRepository(PasswordReset::class)
            ->createQueryBuilder('pr')
            ->update()
            ->set('pr.isActive', 0)
            ->where('pr.email = :email',)
            ->andWhere('ulc.isActive = 1')
            ->setParameter('email', $email)
            ->getQuery()
            ->execute();
    }

    public function updatePassword(User $user, string $password): void
    {
        $this->entityManagerService->wrapInTransaction(function () use ($user, $password) {
            $this->deactivateAllPasswordResets($user->getEmail());
            $user->setPassword($this->hashService->hashPassword($password));
            $this->entityManagerService->sync($user);
        });
    }
}
