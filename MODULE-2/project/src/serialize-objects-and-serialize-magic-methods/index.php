<?php



namespace App13;



require_once '../../src/vendor/autoload.php'; // imports the composer's autoloader


use App13\Invoice;


$invoice = new Invoice('example', 23.3, 'Invoice 1', '123456789');


echo serialize(true) . PHP_EOL;
echo serialize(1) . PHP_EOL;
echo serialize(2.5) . PHP_EOL;
echo serialize('hello world') . PHP_EOL;
echo serialize([1, 2, 3]) . PHP_EOL;
echo serialize(['a' => 1, 'b' => 2]) . PHP_EOL;
var_dump(unserialize(serialize(['a' => 1, 'b' => 2]))); // We can also unserialize the serialized array






$serializedInvoice = serialize($invoice);

echo $serializedInvoice . PHP_EOL . 'EXAMPLE2222';


var_dump(unserialize($serializedInvoice));








$str = serialize($invoice);

$invoice2 = unserialize($str);

var_dump($invoice, $invoice2, $invoice === $invoice2); // comparison will return false, always, because the objects are not the same, they point to different objects in memory.



