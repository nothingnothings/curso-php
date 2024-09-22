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
        // Create the query to sum incomes and expenses grouped by month
        $query = $this->entityManager
            ->getRepository(Transaction::class)
            ->createQueryBuilder('t')
            ->select('MONTH(t.date) AS month, 
                      SUM(CASE WHEN t.amount > 0 THEN t.amount ELSE 0 END) AS income, 
                      SUM(CASE WHEN t.amount < 0 THEN ABS(t.amount) ELSE 0 END) AS expense')
            ->where('t.date >= :startDate')
            ->andWhere('t.date <= :endDate')
            ->setParameter('startDate', new DateTime($year . '-01-01'))
            ->setParameter('endDate', new DateTime($year . '-12-31'))
            ->groupBy('month')
            ->orderBy('month', 'ASC')
            ->getQuery();
    
        // Execute the query and get the result
        $result = $query->getArrayResult();
    
        // Format the result to match the desired output structure
        $monthlySummary = [];
        foreach ($result as $row) {
            $monthlySummary[] = [
                'income' => (int) $row['income'],
                'expense' => (int) $row['expense'],
                'm' => (int) $row['month'],
            ];
        }
    
        return $monthlySummary;
    }
}
