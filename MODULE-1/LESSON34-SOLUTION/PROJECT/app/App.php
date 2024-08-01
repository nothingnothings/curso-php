<?php



declare(strict_types=1);



// Your Code:
function getTransactionFiles(string $dirPath): array
{
    $files = [];

    foreach (scandir($dirPath) as $file) {

        if (is_dir($file)) {
            continue;
        }

        $files[] = $dirPath . $file;
        var_dump($file);
    }

    return $files;
}

// function getTransactions(string $fileName): array
// {
//     $transactions = [];

//     if (!file_exists($fileName)) {
//         trigger_error('File "' . $fileName . '" does not exist', E_USER_ERROR);
//     }

//     $file = fopen($fileName, 'r'); // Will be stored in 'resource' format.

//     fgetcsv($file); // Skip the first line (read it, discarding it).

//    ?  Read csv, line by line, and store each line in an array.
//     while (($line = fgetcsv($file)) !== false) {
//         $transactions[] = extractTransaction($line);
//     }

//     return $transactions;
// }




function getTransactions(string $fileName, ?callable $transactionHandler = null): array
{
    $transactions = [];

    if (!file_exists($fileName)) {
        trigger_error('File "' . $fileName . '" does not exist', E_USER_ERROR);
    }

    $file = fopen($fileName, 'r'); // Will be stored in 'resource' format.

    fgetcsv($file); // Skip the first line (read it, discarding it).

    // Read csv, line by line, and store each line in an array.
    while (($line = fgetcsv($file)) !== false) {
        if ($transactionHandler !== null) {
            $transaction = $transactionHandler($line);
        }


        $transactions[] = $transaction;
    }

    return $transactions;
}


function extractTransaction(array $transactionRow): array
{
    [$date, $checkNumber, $description, $amount] = $transactionRow;

    $amount = (float) str_replace(['$', ','], '', $amount); //remove dollars and commas from value.


    return [
        'date' => $date,
        'checkNumber' => $checkNumber,
        'description' => $description,
        'amount' => $amount,

    ];
}
;



function calculateTotals(array $transactions): array
{
    $totals = [
        'netTotal' => 0,
        'totalIncome' => 0,
        'totalExpense' => 0,
    ];


    foreach ($transactions as $transaction) {
        $totals['netTotal'] += $transaction['amount'];

        if ($transaction['amount'] >= 0) {
            $totals['totalIncome'] += $transaction['amount'];
        } else {
            $totals['totalExpense'] += $transaction['amount'];
        }
    }

    return $totals;
}
