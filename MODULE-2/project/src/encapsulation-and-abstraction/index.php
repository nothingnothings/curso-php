<?php

require '../../vendor/autoload.php'; // imports the composer's autoloader



use App\PaymentGateway\Paddle\Transaction;



$paddleTransaction = new Transaction(25);


$paddleTransaction->process(); // This is good (accessing public method)

// ? Considering that 'amount' is a public property:
// $paddleTransaction->amount = 0; //  This is bad (accessing public properties and altering them)




// Considering that 'amount' is a private property:
$paddleTransaction->amount; // This will give a fatal error (because we tried to access a private property)






// * Trick to BYPASS private property protection (PHP's Reflection API/property):
$paddleTransaction = new Transaction(25);
$reflectionProperty = new ReflectionProperty(Transaction::class, 'amount');
$reflectionProperty->setAccessible(true);
$reflectionProperty->getValue($transaction); // This will return the value of the private property (25, in this case).
$reflectionProperty->setValue($transaction, 200); // This will change the value of the private property to 200.



