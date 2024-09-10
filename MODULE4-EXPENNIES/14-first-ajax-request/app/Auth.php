<?php declare(strict_types=1);

namespace App;

use App\Contracts\AuthInterface;
use App\Contracts\SessionInterface;
use App\Contracts\UserInterface;
use App\Contracts\UserProviderServiceInterface;
use App\DTOs\UserData;
use App\Entity\User;

class Auth implements AuthInterface
{
    private ?UserInterface $user = null;

    public function __construct(private readonly UserProviderServiceInterface $userProvider, private readonly SessionInterface $session) {}

    public function user(): ?UserInterface
    {

        if ($this->user !== null) { 
            return $this->user;
        }

       $userId =  $this->session->get('user');

        if ($userId === null) {
            return null;
        }

        $user = $this->userProvider->getById($userId);

        if (!$user) {
            return null;
        }
        
        $this->user = $user;

        return $this->user;
    }

    public function attemptLogin(array $credentials): bool
    {
        $user = $this->userProvider->getByCredentials($credentials);


        if (!$user || !$this->checkCredentials($user, $credentials)) {
           return false;
        }


        $this->logIn($user);

        return true;
    }

    public function checkCredentials(UserInterface $user, array $credentials): bool
    {

            if (password_verify($credentials['password'], $user->getPassword())) {
                return true;
            }

            return false;
    }

    public function logIn(UserInterface $user): void 
    {
        $this->session->regenerate();
        $this->session->put('user', $user->getId());

        $this->user = $user;
    }

    public function logout(): void
    {
        $this->session->forget('user');
        $this->session->regenerate();

        $this->user = null;
    }

    public function register(UserData $userData): UserInterface
    {
       // Create User:
       $user = $this->userProvider->createUser($userData);

       $this->logIn($user);

       return $user;
    }
}