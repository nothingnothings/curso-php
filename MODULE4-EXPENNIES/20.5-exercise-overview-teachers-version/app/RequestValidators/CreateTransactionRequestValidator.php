<?php

declare(strict_types=1);

namespace App\RequestValidators;

use App\Contracts\RequestValidatorInterface;
use App\Exception\ValidationException;
use App\Services\CategoryService;
use Valitron\Validator;

class CreateTransactionRequestValidator implements RequestValidatorInterface
{

    public function __construct(
        private readonly CategoryService $categoryService
    ) {}


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

        $v->rule(
            function ($field, $value, $params, $fields) use (&$data) {

                $id = (int) $value;

                if (!$id) {
                    return false;
                }

                $category = $this->categoryService->getById($id);

                if ($category) {
                    $data['category'] = $category;

                    return true;
                }

                return false;
            },
            'category'
        )->message('Category not found');

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
