<?php declare(strict_types=1);

namespace App\Contracts;

use App\DataObjects\DataTableQueryParams;
use App\DataObjects\TransactionData;
use App\Entity\Transaction;
use App\Entity\User;
use Doctrine\ORM\Tools\Pagination\Paginator;
use DateTime;

interface TransactionServiceInterface
{
    public function create(TransactionData $transactionData, User $user): Transaction;

    public function getPaginatedTransactions(DataTableQueryParams $params): Paginator;

    public function getById(int $id): ?Transaction;

    public function update(Transaction $transaction, TransactionData $transactionData): Transaction;

    public function toggleReviewed(Transaction $transaction): void;

    public function getTotals(DateTime $startDate, DateTime $endDate, int $userId): array;

    public function getRecentTransactions(int $limit): array;

    public function getMonthlySummary(int $year, int $userId): array;
}
