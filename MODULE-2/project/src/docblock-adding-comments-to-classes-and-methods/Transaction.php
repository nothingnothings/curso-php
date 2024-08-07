<?php


namespace App10;



/**
 * @property int $x;
 * @property float $y;
 */
class Transaction
{


    public function __get(string $name)
    {

    }

    public function __set(string $name, $value): void
    {

    }











    /**
     * Summary of customer2
     * @var Customer
     */
    private $customer2;




    /**
     * Some Description
     * 
     * @param Customer $customer
     * @param float|int $amount
     * 
     * @throws \Exception
     * @throws \Exception2
     * 
     * @return bool
     */




    // * Usage of '@var' tag:
    public function foo(array $arr): void
    {
        /** @var Customer $obj */
        foreach ($arr as $obj) {
            $obj->getName();
        }
    }



    public function process(Customer $customer, float $amount): bool
    {
        // Process Transaction 

        // if failed, return false 

        // otherwise return true

        return true;
    }
}