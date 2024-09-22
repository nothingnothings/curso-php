<?php declare(strict_types=1);

namespace App\Services;

use App\Contracts\EntityManagerServiceInterface;
use App\Contracts\TransactionServiceInterface;
use App\DataObjects\DataTableQueryParams;
use App\DataObjects\TransactionData;
use App\Entity\Transaction;
use App\Entity\User;
use DateTime;
use Doctrine\ORM\Tools\Pagination\Paginator;

class TransactionService implements TransactionServiceInterface
{

    public function __construct(private readonly EntityManagerServiceInterface $entityManager) {}
    
    
    public function create(TransactionData $transactionData, User $user): Transaction
    {
        $transaction = new Transaction();

        $transaction->setUser($user);

        return $this->update($transaction, $transactionData);
    }

    public function getPaginatedTransactions(DataTableQueryParams $params): Paginator
    {
        $query = $this
            ->entityManager
            ->getRepository(Transaction::class)
            ->createQueryBuilder('t')
            ->select('t', 'c', 'r')  // This is to eager load the category-transaction-receipt relationship. Fixes N+1 problem.
            ->leftJoin('t.category', 'c')
            ->leftJoin('t.receipts', 'r')
            ->setFirstResult($params->start)
            ->setMaxResults($params->length);

        $orderBy = in_array($params->orderBy, ['description', 'amount', 'date', 'category'])
            ? $params->orderBy
            : 'date';
        $orderDir = strtolower($params->orderDir) === 'asc' ? 'asc' : 'desc';

        if (!empty($params->searchTerm)) {
            $query
                ->where('t.description LIKE :description')
                ->setParameter('description', '%' . addcslashes($params->searchTerm, '%_') . '%');
        }

        if ($orderBy === 'category') {
            $query->orderBy('c.name', $orderDir);
        } else {
            $query->orderBy('t.' . $orderBy, $orderDir);
        }

        return new Paginator($query);
    }

    public function getById(int $id): ?Transaction
    {
        return $this->entityManager->find(Transaction::class, $id);
    }

    public function update(Transaction $transaction, TransactionData $transactionData): Transaction
    {
        $transaction->setDescription($transactionData->description);
        $transaction->setAmount($transactionData->amount);
        $transaction->setDate($transactionData->date);
        $transaction->setCategory($transactionData->category);



        return $transaction;
    }

    public function toggleReviewed(Transaction $transaction): void
    {
        $transaction->setWasReviewed(!$transaction->wasReviewed());

    }

    public function getTotals(DateTime $startDate, DateTime $endDate): array
    {

        return ['net' => 800, 'income' => 3000, 'expense' => 2200];
    }

    public function getRecentTransactions(int $limit): array 
    {

        // Get user's most recent transactions:
        $recentTransactions = $this->entityManager
                                    ->getRepository(Transaction::class)
                                    ->createQueryBuilder('t')
                                    ->select('t')
                                    ->orderBy('t.date', 'DESC')
                                    ->setMaxResults($limit)
                                    ->getQuery()
                                    ->getResult();

        return $recentTransactions;
        
    }

    public function getMonthlySummary(int $year): array
    {
        return [
            ['income' => 1500, 'expense' => 1100, 'm' => 3],
            ['income' => 2000, 'expense' => 1200, 'm' => 4],
            ['income' => 2500, 'expense' => 1300, 'm' => 5],
            ['income' => 3000, 'expense' => 1400, 'm' => 6],
            ['income' => 3500, 'expense' => 1500, 'm' => 7],
            ['income' => 4000, 'expense' => 1600, 'm' => 8],
            ['income' => 4500, 'expense' => 1700, 'm' => 9],
            ['income' => 5000, 'expense' => 1800, 'm' => 10],
            ['income' => 5500, 'expense' => 1900, 'm' => 11],
            ['income' => 6000, 'expense' => 2000, 'm' => 12],
        ];
    }
}
