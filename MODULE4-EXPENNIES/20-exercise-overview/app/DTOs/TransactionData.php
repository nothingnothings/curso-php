<?php declare(strict_types=1);

namespace App\DTOs;

use App\Contracts\DataTransferObjectInterface;
use DateTime;

class TransactionData 
{
    public function __construct(
        public readonly string $description,
        public readonly int $categoryId,
        public readonly float $amount,
        public readonly ?DateTime $transactionDate = null
    ) {}
}