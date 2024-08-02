<?php


declare(strict_types=1);


// This is the classic object syntax
class Transaction
{
    // public $amount;

    private float $amount1;  // Use private if you want to hide the property from outside the class
    public string $description1;


    private float $amount = 15; // You can set/initialize the property in the Class itself, as a default value.
    private string $description;



    // This is the actual constructor of our classes.
    public function __construct(float $amount, string $description)
    {
        $this->amount = $amount;
        $this->description = $description;

    }

    // This is the destructor of our class. It is called when the object is destroyed (or when there are no more references to the object).
    public function __destruct()
    {
        echo 'Destruct' . $this->description . '<br>';
    }


    // This is a method example:
    public function addTax(float $rate): Transaction // You can return the object itself, if you want to chain methods together.
    {
        $this->amount += $this->amount * $rate / 100;

        return $this; // returns the object itself, so you can chain methods together.
    }

    public function applyDiscount(float $rate): Transaction
    {
        $this->amount -= $this->amount * $rate / 100;

        return $this; // returns the object itself, so you can chain methods together.
    }

    // GETTER example:
    public function getAmount(): float
    {
        return $this->amount;
    }

}



// The Generic stdClass object:
$someObject = new stdClass();


$someObject->a = 1;
$someObject->b = 2;
$someObject->c = 3;
$someObject->d = 4;
$someObject->e = 5;






// Casting values as objects:


$arrayExample = [1, 2, 3];

var_dump((object) $arrayExample);