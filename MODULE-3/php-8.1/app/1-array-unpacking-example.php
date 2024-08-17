<?php declare(strict_types=1);

// * This is an example of a COMMON array unpacking (without associative arrays, and without strings as keys). - This works on all php versions.
// $array1 = [1, 2, 3];
// $array2 = [4, 5, 6];

// $array3 = [...$array1, ...$array2];

// print_r($array3);

// * This is an example of a ARRAY unpacking, but WITH associative arrays, with strings as keys. THIS WORKS ONLY ON PHP 8.1+.

$array1 = ['a' => 1, 'b' => 2, 'c' => 3];
$array2 = ['d' => 4, 'e' => 5, 'f' => 6];
$array3 = [...$array1, ...$array2];
print_r($array3);

// * You can use the site 3v4l.org to test the examples above.
