<?php declare(strict_types=1);

$list = ['a', 'b', 'c'];  // this is an array of type 'list'. It is considered a list.

$list2 = [1, 2, 3];  // this is an array of type 'list'. It is considered a list.

$notList = ['a' => 1, 'b' => 2, 'c' => 3];  // this is an ASSOCIATIVE ARRAY. It is NOT considered a list.

$notList2 = ['a', 'b' => 2, 'c'];  // this is an UNORDERED ARRAY. It is NOT considered a list.

var_dump(array_is_list($list));  // Will return true
var_dump(array_is_list($list2));  // Will return true
var_dump(array_is_list($notList));  // Will return false
var_dump(array_is_list($notList2));  // Will return false

// OUTPUT:
// bool(true)
// bool(true)
// bool(false)
// bool(false)

$list = array_filter($list, fn(string $value) => $value !== 'b');  // * 'array_filter()' will return an UNORDERED ARRAY, as the 'b' element will be removed, and the indexes won't be updated.

var_dump(array_is_list($list));  // * This will return false, as the array is now an UNORDERED ARRAY.

// TODO - To fix that, we can RE-ORDER THE ARRAY, using the function array_values():

$list = array_values($list);  // * This will return an ORDERED ARRAY.

var_dump(array_is_list($list));  // * Will return true
