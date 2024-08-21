<?php declare(strict_types=1);

use App\Invoice;
use App\Payment;
use App\SalesTaxCalculator;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// * Examples of COMPOSITION, through DEPENDENCY INJECTION:
$salesTaxCalculator = new SalesTaxCalculator();

(new Invoice($salesTaxCalculator))->create([
    ['description' => 'Item 1', 'unitPrice' => 15.25, 'quantity' => 1],
    ['description' => 'Item 2', 'unitPrice' => 2, 'quantity' => 2],
    ['description' => 'Item 3', 'unitPrice' => 0.25, 'quantity' => 3],
]);

(new Payment($salesTaxCalculator))->processPayment();
