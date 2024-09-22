<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\EntityManagerServiceInterface;
use App\DataObjects\DataTableQueryParams;
use App\Entity\Category;
use App\Entity\User;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Psr\SimpleCache\CacheInterface;

// class CategoryService extends EntityManagerService
class CategoryService
{
    public function __construct(
        private readonly EntityManagerServiceInterface $entityManager,
        private readonly CacheInterface $cache
    ) {}

    public function create(string $name, User $user): Category
    {
        $category = new Category();

        $category->setUser($user);

        return $this->update($category, $name);
    }

    public function getPaginatedCategories(DataTableQueryParams $params): Paginator
    {
        $query = $this
            ->entityManager
            ->getRepository(Category::class)
            ->createQueryBuilder('c')
            ->setFirstResult($params->start)
            ->setMaxResults($params->length);

        $orderBy = in_array($params->orderBy, ['name', 'createdAt', 'updatedAt']) ? $params->orderBy : 'updatedAt';
        $orderDir = strtolower($params->orderDir) === 'asc' ? 'asc' : 'desc';

        if (!empty($params->searchTerm)) {
            $query->where('c.name LIKE :name')->setParameter('name', '%' . addcslashes($params->searchTerm, '%_') . '%');
        }

        $query->orderBy('c.' . $orderBy, $orderDir);

        return new Paginator($query);
    }

    public function getById(int $id): ?Category
    {
        return $this->entityManager->find(Category::class, $id);
    }

    public function update(Category $category, string $name): Category
    {
        $category->setName($name);

        return $category;
    }

    public function getCategoryNames(): array
    {
        return $this
            ->entityManager
            ->getRepository(Category::class)
            ->createQueryBuilder('c')
            ->select('c.id', 'c.name')
            ->getQuery()
            ->getArrayResult();
    }

    public function getAllKeyedByName(int $userId): array
    {

        $cacheKey = 'categories_keyed_by_name' . $userId;


        // Example of redis implementation (if we have this key in the cache, we return it, without using/resorting to the database):
        if($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        $categories = $this->entityManager->getRepository(Category::class)->findAll();
        $categoryMap = [];

        foreach ($categories as $category) {
            $categoryMap[strtolower($category->getName())] = $category;
        }

        $this->cache->set($cacheKey, $categoryMap);

        return $categoryMap;
    }

    public function getTopSpendingCategories(int $limit): array
    {
        return [
            ['name' => 'Category 1', 'total' => 700],
            ['name' => 'Category 2', 'total' => 600],
            ['name' => 'Category 3', 'total' => 500],
            ['name' => 'Category 4', 'total' => 400],
            ['name' => 'Category 5', 'total' => 300],
        ];
    }
}
