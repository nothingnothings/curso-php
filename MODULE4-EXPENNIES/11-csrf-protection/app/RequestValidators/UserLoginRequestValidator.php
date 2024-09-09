<?php declare(strict_types=1);

namespace App\RequestValidators;

use App\Contracts\RequestValidatorInterface;
use App\DTOs\UserData;
use Doctrine\ORM\EntityManager;

class UserLoginRequestValidator implements RequestValidatorInterface
{
    public function __construct( private readonly EntityManager $entityManager) {}

    public function validate(UserData $userData): array
    {


        $userDataArray = [
            'email' => $userData->email,
            'password' => $userData->password,
        ];

        $v = new \Valitron\Validator($userDataArray);

        $v->rule('required', ['email', 'password']);
        $v->rule('email', 'email');


        if (!$v->validate()) {
            throw new \App\Exception\ValidationException($v->errors());
        }

        return $userDataArray;
    }
}