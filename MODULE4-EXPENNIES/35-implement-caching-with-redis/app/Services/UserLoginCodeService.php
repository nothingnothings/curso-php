<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\EntityManagerServiceInterface;
use App\Entity\User;
use App\Entity\UserLoginCode;

class UserLoginCodeService
{
    public function __construct(
        private readonly EntityManagerServiceInterface $entityManagerService
    ) {}

    // * Generates the 2FA code for the user
    public function generate(User $user): UserLoginCode
    {

        $userLoginCode = new UserLoginCode();

        $userLoginCode->setUser($user);
        $userLoginCode->setCode((string) random_int(100000, 999999));
        $userLoginCode->setIsActive(true);
        $userLoginCode->setExpiration(new \DateTime('+10 minutes'));

        $this->entityManager->sync($userLoginCode);

        return $userLoginCode;
    }

    // * Verifies the 2FA code for the user
    public function verify(User $user, string $code): bool
    {
        $userLoginCode = $this->entityManager->getRepository(UserLoginCode::class)->findOneBy([
            'user' => $user,
            'code' => $code,
            'isActive' => 1,
        ]);

         if (! $userLoginCode) {
             return false;
         }

        if ($userLoginCode->getExpiration() <= new \DateTime()) {
            return false;
        }

        return true;
    }

    public function deactivateAllActiveCodes(User $user): void {

        $this->entityManagerService
        ->getRepository(UserLoginCode::class)
        ->createQueryBuilder('ulc')
        ->update()
        ->set('ulc.isActive', 0)
        ->where('ulc.user = :user', )
        ->andWhere('ulc.isActive = 1')
        ->setParameter('user', $user)
        ->getQuery()
        ->execute();
    }
}
