<?php declare(strict_types=1);

namespace App;

// ! Example of how inheritance SHOULD NOT be used (just to avoid code duplication... this should not be done)
class Invoice extends SalesTaxCalculator
{
    public function create(array $lineItems)
    {
        // Calculate sub total
        $lineItemsTotal = $this->calculateLineItemsTotal($lineItems);

        // Calculate sales tax (imported/inherited from SalesTaxCalculator)
        $salesTax = $this->calculate($lineItemsTotal);

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
}
