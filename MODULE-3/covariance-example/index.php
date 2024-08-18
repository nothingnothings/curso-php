<?php declare(strict_types=1);

// require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/Animal.php';
require_once __DIR__ . '/Cat.php';
require_once __DIR__ . '/Dog.php';
require_once __DIR__ . '/AnimalShelter.php';
require_once __DIR__ . '/Shelters.php';

$kitty = (new CatShelter)->adopt('Ricky');
$kitty->speak();
echo PHP_EOL;

$doggy = (new DogShelter)->adopt('Mavrick');
$doggy->speak();
echo PHP_EOL;
