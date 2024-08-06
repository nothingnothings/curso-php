<?php



require_once '../../src/vendor/autoload.php'; // imports the composer's autoloader



$coffeMaker = new \App6\CoffeeMaker();
$coffeMaker->makeCoffee();

$latteMaker = new \App6\LatteMaker();
$latteMaker->makeCoffee();
$latteMaker->makeLatte();

$cappuccinoMaker = new \App6\CappuccinoMaker();
$cappuccinoMaker->makeCoffee();
$cappuccinoMaker->makeCappuccino();