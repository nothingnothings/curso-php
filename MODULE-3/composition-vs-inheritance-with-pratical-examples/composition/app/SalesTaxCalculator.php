<?php declare(strict_types=1);

namespace App;

// * Example of how composition should be used to IMPROVE your code (pass dependencies in the constructor):
class SalesTaxCalculator
{
    public function calculate(float|int $total): float
    {
        return round($total * 0.07, 2);
    }
}
