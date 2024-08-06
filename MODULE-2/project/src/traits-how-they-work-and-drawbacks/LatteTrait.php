<?php


namespace App6;


trait LatteTrait
{

    protected string $milkType = "whole-milk";

    public function makeLatte()
    {
        echo static::class . ' is making latte with' . $this->milkType . PHP_EOL;
    }
}