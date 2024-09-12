<?php declare(strict_types=1);

namespace App\RequestValidators;

use App\Contracts\RequestValidatorInterface;
use Valitron\Validator;

class CreateTransactionRequestValidator implements RequestValidatorInterface
{
    public function validate($categoryData): array
    {
        $v = new Validator($categoryData);

        $v->rule('required', ['description']);
        $v->rule('required', ['amount']);

        $v->rule(
            'lengthMax',
            'name',
        );

        $dataArray = [
            'name' => $categoryData->name,
        ];

        return $dataArray;
    }
}
