<?php declare(strict_types=1);

namespace App\Services;

use App\Contracts\TransactionServiceInterface;
use App\DTOs\DataTableFilters;
use App\DTOs\TransactionData;
use App\Entity\Category;
use App\Entity\Transaction;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Pagination\Paginator;

class TransactionService implements TransactionServiceInterface
{
    public function __construct(private readonly EntityManager $entityManager) {}



    public function getAll(): array
    {
        return $this->entityManager->getRepository(Transaction::class)->findAll();
    }


    public function create(TransactionData $transactionData, User $user): Transaction
    {
        $transaction = new Transaction();

        $transaction->setUser($user);

        $this->update($transaction, $transactionData);


        return $transaction;
    }


    public function delete(int $id): void
    {
        try {
            $transaction = $this->entityManager->find(Transaction::class, $id);
            
            if ($transaction === null) {
                throw new \Exception("Transaction not found");
            }
    
            $this->entityManager->remove($transaction);
            $this->entityManager->flush();
        } catch (\Exception $e) {
            // Log the exception or handle it
            throw new \Exception("Failed to delete transaction: " . $e->getMessage());
        }
    }

    public function getById(int $id): ?Transaction
    {
        return $this->entityManager->find(Transaction::class, $id);
    }

    public function update(Transaction $transaction, TransactionData $transactionData): Transaction
    {
        $category = $this->entityManager->find(Category::class, $transactionData->categoryId);

        $transaction->setDescription($transactionData->description);
        $transaction->setAmount($transactionData->amount);
        $transaction->setCategory($category);
        $transaction->setDate($transactionData->transactionDate);

        $this->entityManager->persist($transaction);
        $this->entityManager->flush();

        return $transaction;
    }

    // Used with pagination.
    public function getPaginatedCategories(DataTableFilters $dataTableFilters): Paginator
    {

        $start = $dataTableFilters->start ?? 0;
        $length = $dataTableFilters->length ?? 10;
        $orderBy = $dataTableFilters->orderBy ?? 'description';
        $dir = $dataTableFilters->orderDir ?? 'asc';
        $searchTerm = $dataTableFilters->searchTerm ?? '';


        $query = $this->entityManager->getRepository(Transaction::class)
            ->createQueryBuilder('t')  // alias of the table will be 'c'.
            ->setFirstResult($start) // offset. It is the number of rows to skip.
            ->setMaxResults($length); // limit. It is the maximum number of rows to retrieve.

        // We use these 'allow lists' to prevent SQL injection attacks.
        $orderBy = in_array($orderBy, ['description', 'amount', 'category', 'date']) ? $orderBy : 'description';

        $dir = strtolower($dir) === 'asc' ? 'asc' : 'desc';


        if (!empty($searchTerm)) {
            // We escape these special characters, so that they can be used as search terms in our filter/search bar.
            // $searchTerm = str_replace(['%', '_'], ['\%', '\_'], $searchTerm);
            $query->where('t.description LIKE :description')->setParameter('description', '%' . addcslashes($searchTerm, '%_') . '%');
        }

        $query->orderBy('t.' . $orderBy, $dir);

        // return $query->getQuery()->getResult();
        return new Paginator($query);
    }
}