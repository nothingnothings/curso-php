<?php

$transaction_data = [];

$files = scandir(FILES_PATH); // will be an array of file names.

foreach ($files as $file) {

    $file_path = FILES_PATH . $file . "";

    if (is_file($file_path)) {
        $fileContent = fopen($file_path, "r");

        while (($line = fgetcsv($fileContent)) !== false) {
            array_push($transaction_data, $line);
        }

    }
}

array_shift($transaction_data);


foreach ($transaction_data as &$line) {
    $line[3] = str_replace(',', '', $line[3]);
}
;




function getTotalIncome(array $transaction_data)
{

    return round(
        array_reduce(
            $transaction_data,
            fn($sum, $item) => $sum + ((float) str_replace('$', '', $item[3]) > 0 ? (float) str_replace('$', '', $item[3]) : 0),
            0
        ),
        2
    );
}
;


function getTotalExpense(array $transaction_data)
{

    return round(
        array_reduce(
            $transaction_data,
            fn($sum, $item) => $sum + ((float) str_replace('$', '', $item[3]) < 0 ? (float) str_replace('$', '', $item[3]) : 0),
            0
        ),
        2
    );
}

function getNetTotal(array $transaction_data)
{
    return round(
        array_reduce(
            $transaction_data,
            fn($sum, $item) => $sum + ((float) str_replace('$', '', $item[3])),
            0
        ),
        2
    );

}

function formatCurrency(float $amount): string
{
    // Format the absolute value of the number
    $formatted = number_format(abs($amount), 2, '.', ',');

    // Check if the amount is negative and prepend '-' accordingly
    return ($amount < 0 ? '-' : '') . '$' . $formatted;
}

function formatDate(string $date): string
{
    return date('M j, Y', strtotime($date));
}