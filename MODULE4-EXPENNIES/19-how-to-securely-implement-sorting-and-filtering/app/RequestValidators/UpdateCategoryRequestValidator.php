<?php declare(strict_types=1);

namespace App\RequestValidators;

use App\Contracts\RequestValidatorInterface;
use Valitron\Validator;

class UpdateCategoryRequestValidator implements RequestValidatorInterface
{
    public function validate($categoryData): array
    {
        $v = new Validator($categoryData);

        $v->rule('required', ['name']);
        $v->rule(
            'lengthMax',
            'name',
        );
        $v->rule('integer', 'id');

        $dataArray = [
            'name' => $categoryData->name,
        ];

        return $dataArray;
    }
}
