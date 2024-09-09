<?php declare(strict_types=1);

namespace App\RequestValidators;

use App\DTOs\CategoryData;
use Valitron\Validator;

class CreateCategoryRequestValidator
{
    public function validate(CategoryData $categoryData): CategoryData
    {
        $v = new Validator($categoryData);

        $v->rule('required', ['name']);
        $v->rule('string', ['name']);
        $v->rule('lengthMax', 'name', );

        return $categoryData;
    }
}