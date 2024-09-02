<?php declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Services\Shipping\BillableWeightCalculatorService;

$package = [
    'weight' => 6,
    'dimensions' => [
        'width' => 9,
        'height' => 15,
        'length' => 7
    ],
];

$fedexDimDivisor = 139;

$billableWeight = (new BillableWeightCalculatorService())->calculate(
    $package['dimensions']['width'],
    $package['dimensions']['height'],
    $package['dimensions']['length'],
    $package['weight'],
    $fedexDimDivisor
);

echo "Billable Weight: $billableWeight\n";