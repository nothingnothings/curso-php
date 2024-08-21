<?php declare(strict_types=1);

namespace App;

class Invoice
{
    // * COMPOSITION example
    public function __construct(protected SalesTaxCalculator $salesTaxCalculator) {}

    public function create(array $lineItems)
    {
        // Calculate sub total
        $lineItemsTotal = $this->calculateLineItemsTotal($lineItems);

        // * Calculate sales tax (using the injected SalesTaxCalculator, COMPOSITION example)
        $salesTax = $this->salesTaxCalculator->calculate($lineItemsTotal);

        $total = $lineItemsTotal + $salesTax;

        echo 'Sub total: ' . $lineItemsTotal . PHP_EOL;
        echo 'Sales Tax: ' . $salesTax . PHP_EOL;
        echo 'Total: ' . $total . PHP_EOL;
    }

    public function calculateLineItemsTotal(array $items): float|int
    {
        return array_sum(
            array_map(
                fn($item) => $item['unitPrice'] * $item['quantity'],
                $items
            )
        );
    }

    public function calculateSalesTax(float|int $total): float
    {
        return round($total * 0.07, 2);
    }

    public function calculate()
    {
        // Some custom, Invoice class-specific, logic

        // Then, reusing the logic from the SalesTaxCalculator:
        return $this->salesTaxCalculator->calculate(23);
    }
}
