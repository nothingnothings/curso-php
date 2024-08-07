<?php



namespace App13;



require_once '../../src/vendor/autoload.php'; // imports the composer's autoloader


$invoice = new Invoice('example');


echo serialize(true) . PHP_EOL;
echo serialize(1) . PHP_EOL;
echo serialize(2.5) . PHP_EOL;
echo serialize('hello world') . PHP_EOL;
echo serialize([1, 2, 3]) . PHP_EOL;
echo serialize(['a' => 1, 'b' => 2]) . PHP_EOL;
var_dump(unserialize(serialize(['a' => 1, 'b' => 2]))); // We can also unserialize the serialized array




echo serialize($invoice) . PHP_EOL;




var_dump(unserialize('0:11:"App\Invoice": 1:{s:15:"id";s:21:"invoice_512124124das";}'));
