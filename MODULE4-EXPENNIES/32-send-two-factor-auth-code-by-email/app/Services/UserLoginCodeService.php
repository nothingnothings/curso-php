<?php declare(strict_types=1);

namespace App\Services;

use App\Contracts\EntityManagerServiceInterface;
use App\Entity\User;
use App\Entity\UserLoginCode;

class UserLoginCodeService
{
    public function __construct(
        private readonly EntityManagerServiceInterface $entityManager
    ) {}

    public function generate(User $user): UserLoginCode
    {

        $userLoginCode = new UserLoginCode();

        $userLoginCode->setUser($user);
        $userLoginCode->setCode( (string) random_int(100000, 999999));
        $userLoginCode->setIsActive(true);
        $userLoginCode->setExpiration(new \DateTime('+10 minutes'));

        $this->entityManager->sync($userLoginCode);

        return $userLoginCode;
    }
}
