<?php



require '../../vendor/autoload.php'; // imports the composer's autoloader


use App\Enums\Status; // It is best to outsource the enums to a separate file/class
use App\PaymentGateway\Paddle\Transaction;




$paddleTransaction = new Transaction();



// echo Transaction::STATUS_PAID;  // * THIS IS HOW WE ACCESS A CONST THAT WAS DEFINED INSIDE OF A CLASS...

// echo $transaction::STATUS_PAID; // * We can also access the constant on the objects instantiated from the class, without any problems (it's basically the same thing).


$paddleTransaction->setStatus(Status::PAID); // more readable and makes more sense than 'Transaction::STATUS_PAID''

echo Status::PAID; // * This is how we access a constant that was defined INSIDE OF A CLASS