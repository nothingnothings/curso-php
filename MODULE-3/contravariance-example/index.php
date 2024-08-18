<?php declare(strict_types=1);

// require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/Animal.php';
require_once __DIR__ . '/Cat.php';
require_once __DIR__ . '/Dog.php';
require_once __DIR__ . '/AnimalShelter.php';
require_once __DIR__ . '/Shelters.php';
require_once __DIR__ . '/Food.php';
require_once __DIR__ . '/AnimalFood.php';

$kitty = (new CatShelter)->adopt('Ricky');
$kitty->speak();
$catFood = new AnimalFood();
$kitty->eat($catFood);
echo PHP_EOL;

$doggy = (new DogShelter)->adopt('Mavrick');
$doggy->speak();
$dogFood = new Food();
$dogFood->eat($dogFood);
echo PHP_EOL;
