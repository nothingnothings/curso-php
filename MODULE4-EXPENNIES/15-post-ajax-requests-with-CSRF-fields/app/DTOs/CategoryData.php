<?php declare(strict_types=1);

namespace App\DTOs;

use App\Validators\CategoryValidator;

class CategoryData
{
    public function __construct(
        public readonly string $name
    ) {}
}