<?php



declare(strict_types=1);  //esse method/alteracao _ ENABLE _ O STRICT TYPE... (só poderemos passar values com data types adequados como params de nossas functions.. senao, recebemos 1 error)...






function sum(int $x, int $y)
{
    return $x + $y;
}




$sum = sum(2, '4');
