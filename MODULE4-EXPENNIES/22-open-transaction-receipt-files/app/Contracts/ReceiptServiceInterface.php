<?php declare(strict_types=1);

namespace App\Contracts;

use App\Entity\Receipt;
use App\Entity\Transaction;

interface ReceiptServiceInterface
{
    public function create(Transaction $transaction, string $filename, string $storageFilename): Receipt;
}
