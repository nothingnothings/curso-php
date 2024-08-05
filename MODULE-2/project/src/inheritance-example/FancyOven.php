<?php




namespace App2;


// * Example of usage of 'composition' instead of 'inheritance':
class FancyOven
{


    public function __construct(private ToasterPro $toaster)
    {
    }

    // * Example of a method that uses 'composition' instead of 'inheritance':
    public function fry()
    {

    }

    public function toast()
    {
        $this->toaster->toast();
    }

    public function toastBagel()
    {
        $this->toaster->toastBagel();

    }
}