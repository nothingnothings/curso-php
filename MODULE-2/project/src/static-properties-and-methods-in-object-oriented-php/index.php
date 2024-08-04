<?php



require '../../vendor/autoload.php'; // imports the composer's autoloader


use App\PaymentGateway\Paddle\Transaction;

use App\DB;


$paddleTransaction1 = new Transaction();
$paddleTransaction2 = new Transaction();
$paddleTransaction3 = new Transaction();
$paddleTransaction4 = new Transaction();
$paddleTransaction5 = new Transaction();




var_dump($paddleTransaction1::$count); // * This is how to access static properties (you can access them on both objects and classes):



var_dump(Transaction::$count); // You can access the static property on the class itself...


// The value of the dump will be '5', because we created 5 objects of the class 'Transaction', which has logic in the constructor to increment the static property 'count' on each object that gets created.


var_dump(Transaction::getCount2()); // * This is how to access static methods (you can access them on both objects and classes)










// How to use singleton pattern in PHP (calling a static method on the class):
$dbInstance = DB::getInstance(['username' => 'Arthur']);


// It doesn't matter how many times you call the method, because the singleton pattern will only create/maintain a single instance of the class.
$dbInstance = DB::getInstance(['username' => 'Arthur']);
$dbInstance = DB::getInstance(['username' => 'Arthur']);
$dbInstance = DB::getInstance(['username' => 'Arthur']);
$dbInstance = DB::getInstance(['username' => 'Arthur']);
$dbInstance = DB::getInstance(['username' => 'Arthur']);

