<?php


namespace App6;



class CoffeeMaker
{

    public static $foo;


    public function makeCoffee()
    {
        echo static::class . ' is making coffee' . PHP_EOL;
    }
}