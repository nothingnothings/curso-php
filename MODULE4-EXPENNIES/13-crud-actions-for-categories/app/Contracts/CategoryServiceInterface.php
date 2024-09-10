<?php

declare(strict_types=1);

namespace App\Contracts;

use App\DTOs\CategoryData;
use App\Entity\Category;
use App\Entity\User;

interface CategoryServiceInterface
{
    public function create(CategoryData $categoryData, User $user): Category;

    public function getAll(): array;
}
