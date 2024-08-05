<?php




namespace App3;


class CollectionAgency implements DebtCollector
{

    public function __construct()
    {
        echo "";
    }



    public function collect(float $owedAmount): float // enforced by the DebtCollector interface.
    {
        $guaranteed = $owedAmount * 0.5;

        return mt_rand($guaranteed, $owedAmount);
    }

    public function foo(): void // enforced by the AnotherInterface interface (inside of DebtCollector interface).
    {
        echo 'foo';
    }

    public function bar(): void // enforced by the SomeOtherInterface interface (inside of DebtCollector interface).
    {
        echo 'bar';
    }

}