<?php


namespace App6;



class LatteMaker extends CoffeeMaker
{

    use LatteTrait;

    // * OUTSOURCED TO THE 'LatteTrait' trait
    // public function makeLatte()
    // {
    //     echo static::class . ' is making latte' . PHP_EOL;
    // }
}