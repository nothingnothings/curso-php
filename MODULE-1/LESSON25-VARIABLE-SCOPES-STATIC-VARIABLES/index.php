<?php



$x = 5;



function foo()
{

    echo $x; // This won't work - $x is not defined in this local scope.
}


foo();




function foo2()
{
    global $x; /// WITH THIS, WE CAN ACCESS VARIABLES DEFINED GLOBALLY.


    echo $x;
}



foo2();