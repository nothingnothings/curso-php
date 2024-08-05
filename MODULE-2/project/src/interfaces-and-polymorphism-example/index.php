<?php


require '../../src/vendor/autoload.php'; // imports the composer's autoloader




// $collector = new \App3\CollectionAgency();
$collector = new \App3\RockyTheDebtCollector();


$service = new \App3\DebtCollectionService();

$service->collectDebt($collector);


// echo $collector->collect(400); // the owed amount is 400, the guaranteed amount (least) is 200.
