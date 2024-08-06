<?php


namespace App6;



class CappuccinoMaker extends CoffeeMaker
{
    use CappuccinoTrait;


    // * OUTSOURCED TO THE 'CappuccinoTrait' trait
    // public function makeCappuccino()
    // {
    //     echo static::class . ' is making cappuccino' . PHP_EOL;
    // }
}