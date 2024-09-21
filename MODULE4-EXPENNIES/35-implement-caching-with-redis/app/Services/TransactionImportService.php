<?php declare(strict_types=1);

namespace App\Services;

use App\Contracts\EntityManagerServiceInterface;
use App\DataObjects\TransactionData;
use App\Entity\Transaction;
use App\Entity\User;
use Clockwork\Clockwork;
use Clockwork\Request\LogLevel;
use Psr\SimpleCache\CacheInterface;

class TransactionImportService
{

    public function __construct(
        private readonly TransactionService $transactionService,
        private readonly CategoryService $categoryService,
        private readonly EntityManagerServiceInterface $entityManagerService,
        private readonly Clockwork $clockwork,
    ) {

    }

    public function importFromFile(string $file, User $user): void
    {


        $resource = fopen($file, 'r');
        $categories = $this->categoryService->getAllKeyedByName(); // * This is MUCH BETTER than trying to find each category by name, individually.

        // Discard the header row
        fgetcsv($resource);

        // Log memory and unit of work usage and detect memory leaks:
        $this->clockwork->log(LogLevel::DEBUG, 'Memory Usage Before: ' . memory_get_usage(true));
        $this->clockwork->log(LogLevel::DEBUG, 'Unit of Work Before: ' . $this->entityManager->getUnitOfWork()->size());

        $count = 1;
        $batchSize = 250;
        while (($row = fgetcsv($resource)) !== false) {
            [$date, $description, $category, $amount] = $row;

            $date     = new \DateTime($date);
            $category = $categories[strtolower($category)] ?? null;
            $amount   = str_replace(['$', ','], '', $amount);

            $transactionData = new TransactionData($description, (float) $amount, $date, $category);

            $transaction = $this->transactionService->create($transactionData, $user);

            $this->entityManagerService->persist($transaction);

            // If the current count/row is a multiple of the batchsize (250, 500, 750, etc), we flush a single time.
            if ($count % $batchSize === 0) {
                // Call flush, then reset the counter, every time we reach 250, 500, 750, etc.
                $this->entityManagerService->sync();
                // $this->entityManagerService->clear(Transaction::class); // ! This was DEPRECATED; we must use the version seen on the line below.
                $this->entityManagerService->clear(Transaction::class); // * The logic seen in this method, in our custom service class, is not deprecated: https://github.com/doctrine/orm/issues/8460 

                $count = 1;
            } else {
                $count++; 
            }

        }

        if ($count > 1) {
            $this->entityManagerService->sync();
            $this->entityManagerService->clear();
        }

       
        $this->clockwork->log(LogLevel::DEBUG, 'Memory Usage After: ' . memory_get_usage(true));
        $this->clockwork->log(LogLevel::DEBUG, 'Unit of Work After: ' . $this->entityManager->getUnitOfWork()->size());
        
    }
}