<?php declare(strict_types=1);

namespace App\Contracts;

use App\DTOs\CategoryData;
use App\DTOs\DataTableFilters;
use App\Entity\Category;
use App\Entity\User;
use Doctrine\ORM\Tools\Pagination\Paginator;

interface CategoryServiceInterface
{
    public function create(CategoryData $categoryData, User $user): Category;

    public function getAll(): array;

    public function delete(int $id): void;

    public function getById(int $id): ?Category;

    public function update(Category $category, string $name): Category;

    public function getPaginatedCategories(DataTableFilters $dataTableFilters): Paginator;
}
