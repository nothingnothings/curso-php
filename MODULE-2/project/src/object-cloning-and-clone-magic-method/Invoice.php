<?php


namespace App11;



class Invoice
{
    private string $id;



    public function __construct()
    {
        $this->id = uniqid('invoice_');

    }

    public static function create(): static
    {
        return new static();
    }


    // This method is called, from the inside of the clone, whenever the object is cloned
    public function __clone(): void
    {
        // Generate new unique id, whenever the object is cloned.
        $this->id = uniqid('invoice_');
    }
}