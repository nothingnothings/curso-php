<?php


namespace App6;


// * ''Multiple inheritance' using traits example:
class AllInOneCoffeeMaker
{
    use LatteTrait; // Lets us use the makeLatte() and makeCappuccino() methods.
    use CappuccinoTrait;
}






// ! 'MULTIPLE INHERITANCE' using interfaces example (code gets very bloated, lots of code duplication)
// class AllInOneCoffeeMaker extends CoffeeMaker implements MakesLatte, MakesCappuccino
// {

//     public function makeLatte()
//     {
//         echo static::class . ' is making latte' . PHP_EOL;
//     }

//     public function makeCappuccino()
//     {
//         echo static::class . ' is making cappuccino' . PHP_EOL;
//     }

// }

