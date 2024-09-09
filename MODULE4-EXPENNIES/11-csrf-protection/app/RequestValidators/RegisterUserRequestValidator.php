<?php declare(strict_types=1);

namespace App\RequestValidators;

use App\Contracts\RequestValidatorInterface;
use App\DTOs\UserData;
use App\Entity\User;
use Doctrine\ORM\EntityManager;

class RegisterUserRequestValidator implements RequestValidatorInterface
{
    public function __construct( private readonly EntityManager $entityManager) {}

    public function validate(UserData $userData): array
    {
        $v = new \Valitron\Validator($userData);

        $v->rule('required', ['name', 'email', 'password', 'confirmPassword']);
        $v->rule('email', 'email');
        $v->rule('equals', 'confirmPassword', 'password')->label('Confirm Password');

        $v->rule(
            function ($field, $value, $params, $fields) use ($userData) {
                $numberOfUsers = $this->entityManager->getRepository(User::class)->count(['email' => $value]);

                return !$numberOfUsers;  // will return 'true' if the number is 0 (no users found), and 'false' if the number is 1 (fail-case, when a user already exists with the email).
            }, 'email'
        )->message('User with the given email address already exists.');

        if (!$v->validate()) {
            throw new \App\Exception\ValidationException($v->errors());
        }

        return $v->errors();
    }
}
