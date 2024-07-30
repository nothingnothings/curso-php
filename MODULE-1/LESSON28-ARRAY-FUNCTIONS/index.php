<?php



// * 1) ARRAY_CHUNK() function:
$array = [
    'a' => 1,
    'b' => 2,
    'c' => 3,
    'd' => 4,
    'e' => 5
];

print_r(array_chunk($array, 2)); // With this, we don't preseve keys

print_r(array_chunk($array, 2, true)); // true means preserve keys (or not, with false)

// This function splits an array into chunks of a specified size (in this case, 2)...







// * 2) ARRAY_COMBINE() function:


$array1 = ['a1', 'b1', 'c1'];
$array2 = [5, 10, 15];

print_r(array_combine($array1, $array2));


// this function combines two arrays into one array, with the first array as keys, and the second array as values
// if the amount of keys is not the same as the amount of values, we get an ERROR.



// * 3) ARRAY_FILTER() function:




$arrayNew = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

$evenNumbers = array_filter(
    $arrayNew, // array itself
    fn($number) => $number % 2 === 0 // callback function
);

print_r($evenNumbers);


// array_filter ITERATES OVER EACH ARRAY VALUE, AND THEN PASSES THE VALUE/ELEMENT TO THE GIVEN CALLBACK function...
// If you don't pass anything as the second parameter, PHP will try to filter all falsy values (0, 0.0,  false, [], '', etc.)


// However, the produced array, besides not being the same as the original array, will have gaps in its indexing, which is why we need to re-index it, with array_values()...




// * 4) ARRAY_VALUES() function:




$evenNumbers = array_values($evenNumbers); // Will adequately re-index (0123456) all elements/values inside of our array, numerically.


print_r($evenNumbers);


// array_values() reindexes all the elements/values inside of a given array, numerically (01234567)






// * 5) ARRAY_KEYS() function:




$array = [
    'a' => 5,
    'b' => 10,
    'c' => 15,
    'd' => 5,
    'e' => 10
];


$keys = array_keys($array); // Will print out '([0] => a, [1] => b, [2] => c, [3] => d, [4] => e)'
$specificKeys = array_keys($array, 10); // Will print out '([b] => 10, [1] => e)', which are the elements/keys with the value of '10', in the original array. (this second parameter is optional, and used for searches, with LOOSE comparisons)
$specificKeys2 = array_keys($array, '10', true); // With 'true' as the third parameter, we request a STRICT comparison to find the matching elements in the array.


print_r($keys);
print_r($specificKeys);
print_r($specificKeys2);

// array_keys() returns all the keys inside of a given array, as an array itself.







// * 6) ARRAY_MAP() function:

$arrayOriginal = [1, 2, 3, 4, 5, 6];


$arrayMapped = array_map(

    fn($number) => $number * 3,
    $arrayOriginal
);


print_r($arrayMapped);



// Example with multiple arrays:
$arrayOriginal1 = ['a' => 1, 'b' => 2, 'c' => 3];
$arrayOriginal2 = ['d' => 4, 'e' => 5, 'f' => 6];




$arrayMapped3 = array_map(
    fn($number1, $number2) => $number1 * $number2,
    $arrayOriginal1,
    $arrayOriginal2
);

$arrayMapped4 = array_map(null, $arrayOriginal1, $arrayOriginal2);


print_r($arrayMapped3);
print_r($arrayMapped4);










// array_map() is one of the most used array functions, and it's very versatile.
// It simply applies/runs the callback function you provide, for each element of the array...




// * 7) ARRAY_MERGE() function:




$array10 = [1, 2, 3];
$array20 = [4, 5, 6];
$array30 = [7, 8, 9];


$merged = array_merge($array10, $array20, $array30);


print_r($merged);



// array_merge() merges two or more arrays together, and returns the merged array. 
// ''IF ARRAYS HAVE THE SAME NUMERIC KEYS, IT WILL __NOT__ OVERWRITE_ THE VALUES... INSTEAD, THE VALUES WILL BE __ APPENDED...''





// * 8) ARRAY_REDUCE() function:




$invoiceItems = [
    ['price' => 9.99, 'qty' => 3, 'desc' => 'Item 1'],
    ['price' => 29.99, 'qty' => 1, 'desc' => 'Item 2'],
    ['price' => 149, 'qty' => 1, 'desc' => 'Item 3'],
    ['price' => 14.99, 'qty' => 2, 'desc' => 'Item 4'],
    ['price' => 4.99, 'qty' => 4, 'desc' => 'Item 5'],
];



$totalPrice = array_reduce(
    $invoiceItems,
    fn($sum, $item) => $sum + $item['price'] * $item['qty'],
    0
);

echo $totalPrice;  // 258.9

echo PHP_EOL;

// -- array_reduce() is a method which will reduce the array to a single value, using the callback function that you pass...




// * 9) ARRAY_SEARCH()function:







$searchableArray = ['a', 'b', 'c', 'D', 'ab', 'bc', 'cd', 'b', 'd'];


$foundKey = array_search('c', $searchableArray); // First argument is the 'needle' (thing to be found), the second argument is the HAYSTACK (the array)...



var_dump($foundKey); // Will print out 'int(1)'





// array_search() can be used to search Items inside of an array, and will return the key of the FIRST matching value...
// if it doesn't find anything, it will return bool(false).
// array_search() is case-sensitive, so it will not find 'c' when searching for 'C'.




// * 10) IN_ARRAY() function:




$haystack = ['a', 'b', 'c', 'd'];

$isInArray = in_array('d', $haystack); // Returns true

$isInArray2 = in_array('e', $haystack);  // Returns false


var_dump($isInArray);
var_dump($isInArray2);

PHP_EOL;


// Similar to array_search(), but will return a boolean value (true or false), instead of the key.










// * 11)  ARRAY_DIFF()





$arrayA = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5];
$arrayB = ['f' => 4, 'g' => 5, 'i' => 6, 'j' => 7, 'k' => 8];
$arrayC = ['l' => 3, 'm' => 9, 'n' => 10];



$diffResult = array_diff($arrayA, $arrayB, $arrayC);


print_r($diffResult); // Will print ([a] => 1 [b] => 2), because these are the only values that are only present in the first array.




// -- ''Array_diff()'' will COMPARE THE FIRST ARRAY AGAINST THE REST OF THE GIVEN 
// --    ARRAYS, AND WILL RETURN __ THE _ VALUES_ FROM THE FIRST ARRAY THAT _ ARE 
// --    NOT PRESENT IN ANY OF THE OTHER ARRAYS...''







// * 12) ARRAY_DIFF_ASSOC()





$arrayD = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5];
$arrayE = ['f' => 4, 'g' => 5, 'i' => 6, 'j' => 7, 'k' => 8];
$arrayF = ['l' => 3, 'm' => 9, 'n' => 10];



$diffResult2 = array_diff_assoc($arrayD, $arrayE, $arrayF);


print_r($diffResult2); // Will print ([a] => 1 [b] => 2, [c] => 3, [d] => 4, [5] => 5), BECAUSE ___ ALL THE KEYS IN THE FIRST ARRAY DON'T APPEAR IN THE OTHER 2 ARRAYS...




// same thing as array_diff(), BUT ONLY CHECKS FOR THE SAME __KEYS__ of the first array IN THE 
// OTHER ARRAYS, instead of only the values...







// * 13) ASORT() 





$unsortedInitialArray = ['d' => 3, 'b' => 1, 'c' => 4, 'a' => 2];


print_r($unsortedInitialArray);

asort($unsortedInitialArray); // Will sort the array by values, from the lowest to the highest.


print_r($unsortedInitialArray);





// -- asort() sorts your array BY __ VALUES_... you can pass a different sorting flag, if needed.
// -- asort() will sort the array by values, from the lowest to the highest, by default.





// * 14) KSORT()


$unsortedInitialArray2 = ['d' => 3, 'b' => 1, 'c' => 4, 'a' => 2];
ksort($unsortedInitialArray2); // Will sort the array by keys, from the lowest to the highest (letters or numbers).
print_r($unsortedInitialArray2);



// -- ksort() sorts your array BY __ KEYS_... you can pass a different sorting flag, if needed.
// -- ksort() will sort the array by keys, from the lowest to the highest, by default.




// * 15) USORT()


$unsortedInitialArray3 = ['d' => 3, 'b' => 1, 'c' => 4, 'a' => 2];

print_r($unsortedInitialArray3);


usort($unsortedInitialArray3, fn($a, $b) => $a <=> $b); // WE WANT TO RETURN 0 if a === b, and -1 if a < b, and 1 if a > b.
// will return ([0] => 1, [1] => 2, [2] => 3, [3] => 4)



// USORT LETS YOU PASS ___CUSTOM CALLBACK FUNCTIONS__ , AND SORT ELEMENTS BY WHATEVER CRITERIA YOU WANT...
// usort is tipically used with the spaceship operator (<=>), which returns -1 if the first argument is smaller than the second, and 1 if it's bigger, and 0 if they're equal.
// Usort also removes custom keys, and re-orders the array numerically.



// * 16) ARRAY DESTRUCTURING (not a function, but a language construct, but it's still useful):


$arrayExample = [1, 2, 3, 4];


[$a, $b, $c, $d] = $arrayExample;



var_dump($a);
var_dump($b);
var_dump($c);
var_dump($d);