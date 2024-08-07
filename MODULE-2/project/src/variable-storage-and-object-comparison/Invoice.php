<?php


namespace App9;

class Invoice
{
    public int $amount;

    public function __construct(int $amount)
    {
        $this->amount = $amount;

    }
}