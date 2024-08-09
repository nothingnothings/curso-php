<?php




namespace App17;


class Invoice
{
    public string $id;

    protected string $propertyThatWontBeIteratedOver;


    public function __construct(public float $amount)
    {
        $this->id = random_int(1000, 999999);
    }
}