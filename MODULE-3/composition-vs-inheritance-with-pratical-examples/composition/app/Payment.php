<?php

namespace App;

class Payment
{
    // EXAMPLE OF COMPOSITION, through DEPENDENCY INJECTION.
    public function __construct(protected SalesTaxCalculator $salesTaxCalculator) {}

    public function processPayment()
    {
        // ...
        $this->salesTaxCalculator->calculate(200);
        // ...
    }
}
