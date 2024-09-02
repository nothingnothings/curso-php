<?php declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Enums\DimDivisorEnum;
use App\Services\Shipping\BillableWeightCalculatorService;
use App\Services\Shipping\PackageDimensions;
use App\Services\Shipping\Weight;

$package = [
    'weight' => 6,
    'dimensions' => [
        'width' => 9,
        'height' => 15,
        'length' => 7
    ],
];


// ! Without value objects:
// $fedexDimDivisor = 139;

// $billableWeight = (new BillableWeightCalculatorService())->calculate(
//     $package['dimensions']['width'],
//     $package['dimensions']['height'],
//     $package['dimensions']['length'],
//     $package['weight'],
//     $fedexDimDivisor
// );

// * With value objects:
$packageDimensions = new PackageDimensions(
    $package['dimensions']['width'],
    $package['dimensions']['height'],
    $package['dimensions']['length']
);

$packageWeight = new Weight($package['weight']);

$billableWeight = (new BillableWeightCalculatorService())->calculate(
    $packageDimensions,
    $packageWeight,
    DimDivisorEnum::FEDEX
);

echo "Billable Weight: $billableWeight\n";

$packageDimensions2 = new PackageDimensions(
    $package['dimensions']['width'],
    $package['dimensions']['height'],
    $package['dimensions']['length']
);

$packageDimensions2->increaseWidth(10);

$billableWeight2 = (new BillableWeightCalculatorService())->calculate(
    $packageDimensions2,
    $packageWeight,
    DimDivisorEnum::FEDEX
);

echo "Billable Weight: $billableWeight2\n";
