<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\EntityManagerServiceInterface;
use App\DataObjects\DataTableQueryParams;
use App\Entity\Category;
use App\Entity\Transaction;
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
        // Create the query to sum income grouped by category
        $query = $this->entityManager
            ->getRepository(Transaction::class)
            ->createQueryBuilder('t')
            ->select('c.id AS category_id, c.name AS category_name, 
                      SUM(CASE WHEN t.amount > 0 THEN t.amount ELSE 0 END) AS total_income')
            ->innerJoin('t.category', 'c') // Join with the Category entity
            ->groupBy('c.id, c.name')
            ->orderBy('total_income', 'DESC')
            ->setMaxResults($limit)
            ->getQuery();
    
        // Execute the query and get the result
        $result = $query->getArrayResult();
    
        // Format the result to match the desired output structure
        $topCategories = [];
        foreach ($result as $row) {
            $topCategories[] = [
                'name' => $row['category_name'],
                'total' => (int) $row['total_income'],
            ];
        }
    
        return $topCategories;
    }
}
