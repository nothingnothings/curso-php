<?php

namespace App16;

class InvoiceException extends \Exception
{

    // STATIC METHOD
    public static function missingBillingInfo(): static
    {
        return new static('Missing Billing Info');
    }


    public static function invalidAmount(): static
    {
        return new static('Invalid Amount');
    }
}