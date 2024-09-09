<?php

declare(strict_types=1);

namespace App\Contracts;

use App\DTOs\CategoryData;
use App\Entity\Category;

interface CategoryServiceInterface
{
    public function create(CategoryData $categoryData): Category;
}
