<?php



namespace App3;


class RockyTheDebtCollector implements DebtCollector
{
    public function __construct()
    {
        echo "";
    }

    public function collect(float $owedAmount): float
    {
        return $owedAmount * 0.65;
    }

    public function foo(): void
    {
        echo 'foo';
    }

    public function bar(): void
    {
        echo 'bar';
    }

}