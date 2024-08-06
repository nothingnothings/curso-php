<?php



require_once '../../vendor/autoload.php'; // imports the composer's autoloader



$invoice = new app3\Invoice();




$invoice->amount; // This will trigger the __get() magic method, which will dump the string 'amount'



$invoice->amount = 15; // This will trigger the __set() magic method, which will dump the string 'amount'




var_dump(isset($invoice->data)); // This will trigger the __isset() magic method, which will return a boolean because of our logic of array_key_exists().




unset($invoice->data); // This will trigger the __unset() magic method, which will dump the string 'data'



$invoice->inexistentMethod(); // This will trigger the __call() magic method, which is triggered when you try to call a method that doesn't exist.


$invoice::inexistentStaticMethod(); // This will trigger the __callStatic() magic method, which is triggered when you try to call a static method that doesn't exist.




$invoice->process();




echo $invoice; // This will trigger the __toString() magic method, which is triggered when you try to echo or convert the object to a string.




$invoice = new app3\Invoice();

var_dump(is_callable($invoice)); // this will return 'false' if the __invoke() magic method is not defined, and true if otherwise.


$invoice(); // This will trigger the __invoke() magic method, which is triggered when you try to call the object as a function.

