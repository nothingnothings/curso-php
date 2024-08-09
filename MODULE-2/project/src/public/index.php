<?php


// require_once '../PaymentProfile.php';
// require_once '../Customer.php';
// require_once '../TransactionWithPropertyPromotion.php';


// $transaction = new TransactionShortHand(5, 'Test');



// Example of nullsafe operator (the '?' at the end of the object name). We use this operator to enforce that 'the customer might be null'... 
// echo $transaction->customer?->PaymentProfile->id ?? 'foo'; // example with property access,and not method access.



// example with method access // ! WON'T WORK, BECAUSE null coalescing operator DOESN'T WORK WITH METHOD CALLS...
// echo $transaction->getCustomer()->getPaymentProfile()->id ?? 'foo';


// * THIS WILL WORK, BECAUSE the 'nullsafe operator' WORKS with method calls, if you use it with the null coalescing operator.
// echo $transaction->getCustomer()?->getPaymentProfile()?->id ?? 'foo';





declare(strict_types=1);


namespace App19;


// 'SUPERGLOBALS' lesson:
// echo '<pre>';
// print_r($_SERVER);
// echo '</pre>';


require_once __DIR__ . "/../vendor/autoload.php"; // imports the composer's autoloader


$router = new Router();


// $router->register('/', function () {
//     echo '<h1>Home</h1>';
// });


$router->register('/', [\App19\Classes\Home::class, 'index'])
        ->register('/invoices', [\App19\Classes\Invoices::class, 'index'])
        ->register('/invoices/create', [\App19\Classes\Invoices::class, 'create']);



// $router->register('/invoices', function () {
//     echo '<h1>Invoices</h1>';
// });



echo $router->resolve($_SERVER['REQUEST_URI']);