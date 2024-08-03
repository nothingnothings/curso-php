<?php



// * We comment these out, because we will use the autoloader (spl_autoload_register) to load the classes.
// require_once '../app/PaymentGateway/Stripe/Transaction.php';
// require_once '../app/Notification/Email.php';
// require_once '../app/PaymentGateway/Paddle/CustomerProfile.php';
// require_once '../app/PaymentGateway/Paddle/Transaction.php';



// ? AUTOLOADER EXAMPLE (loads, with 'require', the needed classes automatically) - we should still use composer:
// spl_autoload_register(function ($class) {

//     $path = __DIR__ . '/../' . lcfirst(str_replace('\\', '/', $class)) . '.php';

//     if (file_exists($path)) {
//         require $path;
//     }

// });

// // ? AUTOLOADER EXAMPLE:
// spl_autoload_register(function ($class) {
//     var_dump('Autoloader 2');
// }, prepend: true); /// Named Argument example (will make this autoloader run first, before the 'Autoloader 1');



// * Composer autoloader example (use composer's autoloader, which will load the classes automatically):
// require __DIR__ . '/../vendor/autoload.php'; // imports the composer's autoloader

require '../../vendor/autoload.php'; // imports the composer's autoloader

$id = new \Ramsey\Uuid\UuidFactory(); // example of usage of package installed with composer.


echo $id->uuid4();


use App\PaymentGateway\Paddle\Transaction;


$paddleTransaction = new Transaction(); // Will be the paddle transaction


// var_dump(new Transaction());




