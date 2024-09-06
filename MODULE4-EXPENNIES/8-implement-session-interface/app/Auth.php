<?php declare(strict_types=1);

namespace App;

use App\Contracts\AuthInterface;
use App\Contracts\UserInterface;
use App\Contracts\UserProviderServiceInterface;

class Auth implements AuthInterface
{
    private ?UserInterface $user = null;

    public function __construct(private readonly UserProviderServiceInterface $userProvider,) {}

    public function user(): ?UserInterface
    {

        if ($this->user !== null) { 
            return $this->user;
        }

        $userId = $_SESSION['user'] ?? null;

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

        // 2.3 Regenerate the user's sessionid, to improve security and defend against session hijacking attacks. // * DONE
        session_regenerate_id(true);

        $_SESSION['user'] = $user->getId();


        $this->user = $user;

        return true;
    }



    public function checkCredentials(UserInterface $user, array $credentials): bool
    {

            if (password_verify($credentials['password'], $user->getPassword())) {
                return true;
            }

            return false;
    }

    public function logout(): void
    {
        unset($_SESSION['user']);
        $this->user = null;
    }
}