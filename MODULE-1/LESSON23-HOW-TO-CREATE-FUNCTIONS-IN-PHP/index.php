<?php



declare(strict_types=1);

// Functions 
function add($a, $b)
{
    return $a + $b;
}








// Type Hinting:
function add2($a, $b): int // With this, we hint that the returned value is an integer  // ! THIS ONLY WORKS IF YOU HAVE STRICT TYPES ACTIVATED.
{
    return $a + $b;
}



add2(1, 2);




function messager(): void // With this, we hint that the function returns nothing
{
    echo "Hello World!";
}



// NULLABLE TYPES:
function foo(): ?int  // With this, we hint that the function returns an integer OR NULL...
{
    return null;
}


// UNION TYPES (different types can be returned):
function foo2(): int|float|array
{
    // return 1.0;
    // return [];
    return 1;
}

// Mixed type:
function foo3(): mixed // This is the same as null|int|float|array|string, and other types. Limited usefulness.
{
    return 1;
}