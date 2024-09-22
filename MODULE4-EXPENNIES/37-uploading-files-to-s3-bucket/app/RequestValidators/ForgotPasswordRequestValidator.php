<?php declare(strict_types = 1);

namespace App\RequestValidators;

use App\Contracts\RequestValidatorInterface;
use App\Exception\ValidationException;
use Valitron\Validator;

class ForgotPasswordRequestValidator implements RequestValidatorInterface
{
    public function validate(array $data): array
    {
        $v = new Validator($data);

        $v->rule('required', ['email']);
        $v->rule('email', 'email');

        if (! $v->validate()) {
            throw new ValidationException($v->errors());
        }

        // Check if the email exists in the database
        if (! $this->userExists($data['email'])) {
            throw new ValidationException(['email' => ['The email does not exist in our records.']]);
        }

        return $data;
    }

    private function userExists(string $email): bool
    {
        // TODO
    }

}