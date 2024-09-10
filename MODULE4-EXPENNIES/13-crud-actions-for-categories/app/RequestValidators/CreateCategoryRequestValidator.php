<?php

declare(strict_types=1);

namespace App\RequestValidators;

use App\Contracts\RequestValidatorInterface;
use App\DTOs\CategoryData;
use Valitron\Validator;

class CreateCategoryRequestValidator implements RequestValidatorInterface
{
    public function validate($categoryData): array
    {
        $v = new Validator($categoryData);

        $v->rule('required', ['name']);
        $v->rule('lengthMax', 'name',);

        $dataArray = [
            'name' => $categoryData->name,
        ];

        return $dataArray;
    }
}
