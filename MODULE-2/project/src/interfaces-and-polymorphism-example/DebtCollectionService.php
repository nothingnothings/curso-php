<?php




namespace App3;


// This class will show the usefulness of interfaces to avoid problems in the code.
class DebtCollectionService
{

    // Will: 1) FIGURE OUT HOW MUCH IS OWED; 2) CALL THE collect method, in the $collector object; 3) RUN SOME PROCESSING
    // public function collectDebt(CollectionAgency $collector): void // ! THIS IS WRONG, BECAUSE IT IS TOO SPECIFIC (we are only accepting CollectionAgency objects).
    public function collectDebt(DebtCollector $collector): void // * THIS IS RIGHT, BECAUSE IT IS MORE GENERAL (we are accepting DebtCollector objects, which are, in our case, both RockyTheDebtCollector and CollectionAgency).
    {
        $owedAmount = mt_rand(100, 1000); // RANDOM VALUE BETWEEN 100 and 1000.

        $collectedAmount = $collector->collect($owedAmount);

        echo "The collected amount is {$collectedAmount}.";
    }
}