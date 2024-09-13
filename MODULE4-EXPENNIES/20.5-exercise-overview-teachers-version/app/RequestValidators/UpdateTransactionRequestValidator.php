<?php declare(strict_types=1);

namespace App\RequestValidators;

use App\Contracts\RequestValidatorInterface;
use App\Exception\ValidationException;
use Valitron\Validator;

class UpdateTransactionRequestValidator implements RequestValidatorInterface
{
    public function validate(array $data): array
    {
        $v = new Validator($data);

        $v->rule('optional', ['description', 'id', 'amount', 'category']);
        $v->rule('lengthMax', 'description', 500);
        $v->rule('integer', 'id');
        $v->rule('numeric', 'amount');
        $v->rule('numeric', 'category');

        if (!$v->validate()) {
            throw new ValidationException($v->errors());
        }

        return $data;
    }
}
