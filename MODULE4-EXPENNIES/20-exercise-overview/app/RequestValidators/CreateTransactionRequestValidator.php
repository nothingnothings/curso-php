<?php declare(strict_types=1);

namespace App\RequestValidators;

use App\Contracts\RequestValidatorInterface;
use App\DTOs\TransactionData;
use Valitron\Validator;

class CreateTransactionRequestValidator implements RequestValidatorInterface
{
    public function validate(array $data): array
    {
        $v = new Validator($data);

        $v->rule('required', ['description']);
        $v->rule('required', ['amount']);

        $v->rule(
            'lengthMax',
            'name',
        );

        $dataArray = [
            'description' => $data['description'],
        ];

        return $dataArray;
    }
}
