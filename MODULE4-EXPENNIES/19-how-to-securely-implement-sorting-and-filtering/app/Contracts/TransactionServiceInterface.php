<?php declare(strict_types=1);

namespace App\Contracts;

use App\DTOs\TransactionData;
use App\Entity\Transaction;
use App\Entity\User;

interface TransactionServiceInterface
{
    public function create(TransactionData $transactionData, User $user): void;

    public function getAll(): array;

    public function getById(int $id): ?Transaction;

    public function update(Transaction $transaction, string $name): void;

    public function delete(int $id): void;
}
