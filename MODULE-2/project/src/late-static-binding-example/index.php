<?php



require_once '../../src/vendor/autoload.php'; // imports the composer's autoloader



// $classA = new \App5\ClassA();
// $classB = new \App5\ClassB();


// echo $classA->getName() . PHP_EOL;
// echo $classB->getName() . PHP_EOL;




// echo \App5\ClassA::getName() . PHP_EOL;
// echo \App5\ClassB::getName() . PHP_EOL;





var_dump(\App5\ClassA::make());
var_dump(\App5\ClassB::make());
