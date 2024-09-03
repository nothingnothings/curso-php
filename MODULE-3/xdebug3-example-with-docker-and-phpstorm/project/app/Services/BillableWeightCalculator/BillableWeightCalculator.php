<?php declare(strict_types=1);

namespace App\Services\Shipping;

use App\Enums\DimDivisorEnum;
use App\Services\Shipping\PackageDimensions;
use App\Services\Shipping\Weight;

class BillableWeightCalculatorService
{
    public function calculate(
        // int $width,
        // int $height,
        // int $length,
        // int $weight,
        // int $dimDivisor
        PackageDimensions $packageDimensions,  // * Example of value object usage.
        Weight $weight,  // * Another example of value object usage.
        DimDivisorEnum $dimDivisor  // * This is an enum. Better type hinting.
    ): int {
        // Basic validation, to avoid invalid values:
        // match (true) {
            // $width < 0 || $width > 80 => throw new \InvalidArgumentException('Invalid package width '),
            // $height < 0 || $height > 70 => throw new \InvalidArgumentException('Invalid package height '),
            // $length < 0 || $length > 120 => throw new \InvalidArgumentException('Invalid package length '),
            // $weight < 0 || $weight > 150 => throw new \InvalidArgumentException('Invalid package weight '),
            // $dimDivisor <= 0 => throw new \InvalidArgumentException('Invalid dim divisor '),
        //     default => true
        // };

        // ! Without value objects:
        // $dimWeight = (int) round($width * $height * $length / $dimDivisor);

        // * With value objects:
        $dimWeight = (int) round($packageDimensions->width * $packageDimensions->height * $packageDimensions->length / $dimDivisor->value);

        return max($weight->value, $dimWeight);
    }
}
