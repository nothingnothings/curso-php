<?php


namespace App13;



class Invoice
{
    protected string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

}