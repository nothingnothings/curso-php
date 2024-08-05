<?php


namespace App2;


class ToasterProWithConstructor extends ToasterWithConstructor
{

    public int $size;


    public function __construct()
    {
        parent::__construct(); // In javascript, this would be super(). Always call it before doing anything else.
        $this->size = 4;
    }

    // * How to build upon the parent class method's logic, using 'parent::methodName()' (this is completely optional, of course):
    public function addSlice(string $slice): void
    {
        parent::addSlice($slice); // Will call the parent class's addSlice method, just as if you were calling 'super()', with the constructor example.

        echo 'Some stuff here...' . PHP_EOL; // Additional logic, besides the parent class's addSlice method.
    }



    public function toastBagel()
    {
        foreach ($this->slices as $i => $slice) {
            echo ($i + 1) . ': Toasting ' . $slice . ' with bagel option' . PHP_EOL;
        }
    }
}