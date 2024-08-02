<?php


declare(strict_types=1);


// This is the classic object syntax
class Transaction
{
    // public $amount;

    private float $amount;  // Use private if you want to hide the property from outside the class
    public string $description;
}