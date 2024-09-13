<?php declare(strict_types=1);

namespace App\RequestValidators;

use App\Contracts\RequestValidatorInterface;
use App\Exception\ValidationException;
use Valitron\Validator;

class CreateTransactionRequestValidator implements RequestValidatorInterface
{
    public function validate(array $data): array
    {
        $v = new Validator($data);

        $v->rule('required', ['description', 'category', 'amount', 'date']);

        $v->rule(
            'lengthMax',
            'description',
            500
        );

        $v->rule(
            'integer',
            'category'
        );

        $v->rule(
            'numeric',
            'amount'
        );

        $v->rule(
            'date',
            'date'
        );

        if (!$v->validate()) {
            throw new ValidationException($v->errors());
        }

        $dataArray = [
            'description' => $data['description'],
            'amount' => $data['amount'],
            'category' => $data['category'],
            'date' => $data['date']
        ];

        return $dataArray;
    }
}
