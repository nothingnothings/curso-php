<?php declare(strict_types=1);

namespace App;

class SalesTaxCalculator
{
    public function calculate(float|int $total): float
    {
        return round($total * 0.07, 2);
    }
}
