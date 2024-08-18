<?php declare(strict_types=1);

function sum(float ...$num): float
{
    return array_sum($num);
}

$closure = Closure::fromCallable('sum');  // *Old Syntax/way of creating a Closure.

$closure = sum(...);  // * New Syntax/way of creating a Closure, in PHP 8.1.

var_dump($closure);

echo $closure(2, 5) . PHP_EOL;
