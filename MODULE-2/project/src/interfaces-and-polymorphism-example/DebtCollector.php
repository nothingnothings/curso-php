<?php


namespace App3;


// * Interface example:
interface DebtCollector extends AnotherInterface, SomeOtherInterface
{
    // public int $x; // ! THIS IS NOT ALLOWED (properties are not allowed in interfaces).

    public const MY_CONSTANT = 1; // * But this is allowed (constants are allowed in interfaces).


    public function __construct(); // * Forces the child classes to implement this magic method (this means that magic methods can also be enforced).




    public function collect(float $owedAmount): float;   // We want the child classes to implement this method, concretely.
}