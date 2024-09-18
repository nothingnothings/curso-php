<?php declare(strict_types=1);

namespace App\Services;

use App\Contracts\ReceiptServiceInterface;
use App\Entity\Receipt;
use App\Entity\Transaction;

class ReceiptService extends EntityManagerService implements ReceiptServiceInterface
{
    public function create(Transaction $transaction, string $filename, string $storageFilename, string $mediaType): Receipt
    {
        $receipt = new Receipt();

        $receipt->setTransaction($transaction);
        $receipt->setFilename($filename);
        $receipt->setStorageFilename($storageFilename);
        $receipt->setMediaType($mediaType);
        $receipt->setCreatedAt(new \DateTime());

        $this->entityManager->persist($receipt);

        return $receipt;
    }

    public function getById(int $id): ?Receipt
    {
        return $this->entityManager->find(Receipt::class, $id);
    }

    public function delete(Receipt $receipt): void
    {
        $this->entityManager->remove($receipt);
    }
}