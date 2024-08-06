<?php

namespace App6;

trait CappuccinoTrait
{

    use LatteTrait; // You can also use/import traits inside of other traits

    public function makeCappuccino()
    {
        echo static::class . ' is making cappuccino' . PHP_EOL;
    }
}