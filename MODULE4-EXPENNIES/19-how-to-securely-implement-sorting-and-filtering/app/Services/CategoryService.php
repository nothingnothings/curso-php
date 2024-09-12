<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\CategoryServiceInterface;
use App\DTOs\CategoryData;
use App\DTOs\DataTableFilters;
use App\Entity\Category;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Pagination\Paginator;

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

        $category->setUser($user);


        // $category->setName($categoryData->name);
        // $this->entityManager->persist($category);
        // $this->entityManager->flush();

        $this->update($categoryData, $category);

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

    public function update(Category $category, CategoryData $categoryData): void
    {
        $category->setName($categoryData->name);

        $this->entityManager->persist($category);

        $this->entityManager->flush();
    }

    // Used with pagination.
    public function getPaginatedCategories(DataTableFilters $dataTableFilters): Paginator
    {

        $start = $dataTableFilters->start ?? 0;
        $length = $dataTableFilters->length ?? 10;
        $orderBy = $dataTableFilters->orderBy ?? 'name';
        $dir = $dataTableFilters->orderDir ?? 'asc';
        $searchTerm = $dataTableFilters->searchTerm ?? '';


        $query = $this->entityManager->getRepository(Category::class)
            ->createQueryBuilder('c')  // alias of the table will be 'c'.
            ->setFirstResult($start) // offset. It is the number of rows to skip.
            ->setMaxResults($length); // limit. It is the maximum number of rows to retrieve.

        // We use these 'allow lists' to prevent SQL injection attacks.
        $orderBy = in_array($orderBy, ['name', 'createdAt', 'updatedAt']) ? $orderBy : 'name';

        $dir = strtolower($dir) === 'asc' ? 'asc' : 'desc';


        if (!empty($searchTerm)) {
            // We escape these special characters, so that they can be used as search terms in our filter/search bar.
            // $searchTerm = str_replace(['%', '_'], ['\%', '\_'], $searchTerm);
            $query->where('c.name LIKE :name')->setParameter('name', '%' . addcslashes($searchTerm, '%_') . '%');
        }

        $query->orderBy('c.' . $orderBy, $dir);

        // return $query->getQuery()->getResult();
        return new Paginator($query);
    }
}
