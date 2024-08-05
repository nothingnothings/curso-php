<?php



require_once '../../vendor/autoload.php'; // imports the composer's autoloader



$invoice = new app3\Invoice();




$invoice->amount; // This will trigger the __get() magic method, which will dump the string 'amount'



$invoice->amount = 15; // This will trigger the __set() magic method, which will dump the string 'amount'