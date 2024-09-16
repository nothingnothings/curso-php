<?php declare(strict_types=1);

namespace App\Services;

use App\DataObjects\TransactionData;
use App\Entity\Transaction;
use App\Entity\User;
use Clockwork\Clockwork;
use Clockwork\Request\LogLevel;
use Doctrine\ORM\EntityManager;

class TransactionImportService
{

    public function __construct(
        private readonly TransactionService $transactionService,
        private readonly CategoryService $categoryService,
        private readonly EntityManager $entityManager,
        private readonly Clockwork $clockwork
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
            // $category = $this->categoryService->findByName($category); // ! This is BAD, n+1 problem. Unecessary queries, one for each row, instead of a single query returning all categories, beforehand.
            $amount   = str_replace(['$', ','], '', $amount);

            $transactionData = new TransactionData($description, (float) $amount, $date, $category);

            $this->transactionService->create($transactionData, $user);

            // If the current count/row is a multiple of the batchsize (250, 500, 750, etc), we flush a single time.
            if ($count % $batchSize === 0) {
                // Call flush, then reset the counter, every time we reach 250, 500, 750, etc.
                $this->entityManager->flush();
                $this->entityManager->clear(Transaction::class);

                $count = 1;
            } else {
                $count++; 
            }

        }

        if ($count > 1) {
            $this->entityManager->flush();
            $this->entityManager->clear();
        }

        // gc_collect_cycles(); // This will allocate the memory that was not yet garbage collected. (but this is done automaticallly by PHP)

        // Log memory usage and detect memory leaks:
        $this->clockwork->log(LogLevel::DEBUG, 'Memory Usage After: ' . memory_get_usage(true));
        $this->clockwork->log(LogLevel::DEBUG, 'Unit of Work After: ' . $this->entityManager->getUnitOfWork()->size());
        
    }
}