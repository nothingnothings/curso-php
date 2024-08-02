<?php


require_once '../PaymentProfile.php';
require_once '../Customer.php';
require_once '../TransactionWithPropertyPromotion.php';


$transaction = new TransactionShortHand(5, 'Test');



// Example of nullsafe operator (the '?' at the end of the object name). We use this operator to enforce that 'the customer might be null'... 
// echo $transaction->customer?->PaymentProfile->id ?? 'foo'; // example with property access,and not method access.



// example with method access // ! WON'T WORK, BECAUSE null coalescing operator DOESN'T WORK WITH METHOD CALLS...
// echo $transaction->getCustomer()->getPaymentProfile()->id ?? 'foo';


// * THIS WILL WORK, BECAUSE the 'nullsafe operator' WORKS with method calls, if you use it with the null coalescing operator.
echo $transaction->getCustomer()?->getPaymentProfile()?->id ?? 'foo';