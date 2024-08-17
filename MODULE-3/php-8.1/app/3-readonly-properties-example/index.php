<?php declare(strict_types=1);

use PHP_8_1_Examples\ReadOnlyProperty\Address;

require_once __DIR__ . '/../../vendor/autoload.php';

$address = new Address(
    '123 Main Street',
    'Anytown',
    'CA',
    '90210',
    'USA'
);

// echo $address->getStreet() . PHP_EOL; // * getter example (without readonly properties)

echo $address->street;  // * readonly property example (there is no risk of changing the value of the property from outside, you can only access it).

$address->street = '123 asdas';  // * This will not work, because the property is readonly.
