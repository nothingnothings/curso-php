<?php declare(strict_types=1);

namespace App\Services;

use App\Contracts\ReceiptServiceInterface;
use App\Entity\Receipt;
use App\Entity\Transaction;
use Doctrine\ORM\EntityManagerInterface;

class ReceiptService implements ReceiptServiceInterface
{
    public function __construct(private readonly EntityManagerInterface $entityManager) {}

    public function create(Transaction $transaction, string $filename, string $storageFilename): Receipt
    {

        $receipt = new Receipt();

        $receipt->setTransaction($transaction);
        $receipt->setFilename($filename);
        $receipt->setStorageFilename($storageFilename);
        $receipt->setCreatedAt(new \DateTime());

        $this->entityManager->persist($receipt);
        $this->entityManager->flush();

        return $receipt;
    }


}