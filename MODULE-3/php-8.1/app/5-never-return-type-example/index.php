<?php declare(strict_types=1);

// ! This is wrong (we must or throw an exception, or run 'exit' in the function):
// function foo(): never
// {
//     echo '1';
// }

// * This is correct (throw an exception):
// function foo()
// {
//     echo '1';
//     throw new Exception('generic exception');
// }

// * This is correct (exit):
function foo()
{
    echo '1';
    exit;
}

foo();

echo 'I should *never* be printed';
