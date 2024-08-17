<?php declare(strict_types=1);

use PHP_8_1_Examples\Enum\Payment;
use PHP_8_1_Examples\Enum\PaymentStatus;

require_once __DIR__ . '/../../vendor/autoload.php';

$payment = new Payment();

// $payment->updateStatus(PaymentStatus::PAID);  // Without enums.

// $payment->updateStatus(5);  // Without enums - this is bad, will cause errors, which can be avoided by using enums.

$payment->updateStatus(5);  // This will fail

$payment->updateStatus(PaymentStatus::PAID);

// echo $payment->status() . PHP_EOL;

echo $payment->status()->name . PHP_EOL;  // each enum has a 'name' property, which can be used to get the NAME of the enum, as a string value.

echo $payment->status()->value . PHP_EOL;  // each enum has a 'value' property, which can be used to get the VALUE of the enum, as an integer value.
