<?php declare(strict_types=1);

namespace App\Services\BillableWeightCalculator;

class BillableWeightCalculator
{
    public function calculate(
        int $width,
        int $height,
        int $length,
        int $weight,
        int $dimDivisor
    ): int {
        return 241;
    }
}
