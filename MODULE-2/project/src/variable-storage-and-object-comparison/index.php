<?php




use App9\Invoice;


require_once '../../src/vendor/autoload.php'; // imports the composer's autoloader



// $invoice1 = new Invoice(25, 'My Invoice 1');
// $invoice2 = new Invoice(100, 'My Invoice 2');

$invoice1 = new Invoice(25);
$invoice2 = new CustomInvoice(100);


echo 'invoice1 == invoice2' . PHP_EOL;
var_dump($invoice1 == $invoice2);

echo 'invoice1 === invoice2' . PHP_EOL;
var_dump($invoice1 === $invoice2);