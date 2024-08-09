<?php

require_once '../../src/vendor/autoload.php'; // imports the composer's autoloader



use App17\Invoice;

use App17\InvoiceCollection;

// * Common usage of foreach to loop over an array of objects:
foreach (['a', 'b', 'c', 'd', 'e'] as $key => $value) {
    echo '' . $key . ' = ' . $value . '' . PHP_EOL;
}




// * Usage of foreach to loop over an object's PUBLIC properties:
$invoice = new Invoice(100.00);

foreach ($invoice as $key => $value) {
    echo '' . $key . ' = ' . $value . '' . PHP_EOL;
}


$invoiceCollection = new InvoiceCollection([new Invoice(15.0), new Invoice(25.0), new Invoice(50)]);



foreach ($invoiceCollection as $invoice) {
    var_dump($invoice);

    echo '' . $key . ' = ' . $value->amount . '' . PHP_EOL;
}