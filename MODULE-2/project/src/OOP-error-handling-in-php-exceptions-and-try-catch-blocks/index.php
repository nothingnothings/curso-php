<?php




use App16\Customer;
use App16\Invoice;




require_once '../../src/vendor/autoload.php'; // imports the composer's autoloader





$invoice = new Invoice(new Customer());


try {
    $invoice->process(25); // No Exception 
} catch (\App16\MissingBillingInfoException $e) { // We enter this if we get an exception.

    echo 'Entered Catch Block';

    $e->getMessage() . PHP_EOL; // 'getMessage()' is the most used method of the exception/error object.
    $e->getFile() . PHP_EOL;
    $e->getLine() . PHP_EOL;
} catch (\InvalidArgumentException) { // We enter this error block if we get this specific type of exception...
    echo 'Invalid Argument exception';
}


// * This is how you can set a global exception handler:
set_exception_handler(function (\Throwable $e) { // We can also set a global exception handler.
    echo 'Entered Global Exception Handler';
});



$invoice->process(-25); // Exception