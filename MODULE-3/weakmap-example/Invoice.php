<?php

namespace App;

class Invoice
{
    public function __construct(private int $amount = 100, private string $currency = 'USD') {}
}
