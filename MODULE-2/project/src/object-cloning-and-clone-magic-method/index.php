<?php



require_once '../../src/vendor/autoload.php'; // imports the composer's autoloader




$invoice = new \App11\Invoice();


$invoice2 = new $invoice();


// $invoice = $invoice2; // This won't actually clone the object, it will just create a new reference to the same object


$invoice2 = clone $invoice; // * This will actually clone the object. Will also trigger the '__clone()' method, in the cloned object.

var_dump($invoice, $invoice2, \App11\Invoice::create());

