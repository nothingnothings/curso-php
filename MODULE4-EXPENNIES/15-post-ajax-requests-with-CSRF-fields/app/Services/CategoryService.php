<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\CategoryServiceInterface;
use App\DTOs\CategoryData;
use App\Entity\Category;
use App\Entity\User;
use Doctrine\ORM\EntityManager;

class CategoryService implements CategoryServiceInterface
{

    public function __construct(private readonly EntityManager $entityManager) {}



    public function getAll(): array
    {
        return $this->entityManager->getRepository(Category::class)->findAll();
    }


    public function create(CategoryData $categoryData, User $user): Category
    {
        $category = new Category();
        $category->setName($categoryData->name);
        $category->setUser($user);

        $this->entityManager->persist($category);
        $this->entityManager->flush();

        return $category;
    }


    public function delete(int $id): void
    {
       $category = $this->entityManager->find(Category::class, $id);

        $this->entityManager->remove($category);
        $this->entityManager->flush();
    }

    public function getById(int $id): ?Category
    {
        return $this->entityManager->find(Category::class, $id);
    }

    public function update(CategoryData $categoryData, Category $category): void
    {
        $category->setName($categoryData->name);

        $this->entityManager->persist($category);

        $this->entityManager->flush();
    }
}
