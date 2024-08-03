<?php


require_once './PaymentGateway/Stripe/Transaction.php'; // This stays the same, even after creating a namespace.
require_once './PaymentGateway/Paddle/Transaction.php';
require_once './PaymentGateway/Paddle/CustomerProfile.php';
require_once './Notification/Email.php';



// var_dump(new Transaction3());




var_dump(new PaymentGateway\Paddle\Transaction3()); // This is how you use a constant/variable/function/class contained in a namespace...


var_dump(new PaymentGateway\Stripe\Transaction3());










// * ALIASING EXAMPLE:
use PaymentGateway\Paddle\Transaction;
use PaymentGateway\Stripe\Transaction as StripeTransaction;



$paddleTransaction = new Transaction(); // Will be the paddle transaction
$StripeTransaction = new StripeTransaction(); // Will be the ALIASED 'StripeTransaction'... 






// Grouping multiple imported stuff from a namespace together:
use PaymentGateway\Paddle\{Transaction3, CustomerProfile};


$paddleTransaction = new Transaction3();
$paddleCustomerProfile = new CustomerProfile();
