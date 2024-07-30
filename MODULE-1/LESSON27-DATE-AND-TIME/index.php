<?php






// Time Function:

echo time();




$currentTime = time();



echo $currentTime2 . '<br />';


echo $currentTime2 + 5 * 24 * 60 * 60; // 5 days in the future.

echo $currentTime2 - 1 * 24 * 60 * 60; // 1 day in the past. 


// Convert Timestamp into a date:
echo date('', $currentTime);




// Get the properly formatted date and time:
echo date('m/d/Y g:ia'); // Will output something like '01/18/2021 3:09pm'





// Change the timezone, during runtime:
date_default_timezone_set('America/Sao_Paulo');


// Get current timezone:
echo date_default_timezone_get();



// Create timestamp, using mktime():
$timestamp = mktime(0, 0, 0, 1, 1, 2021);
date('m/d/Y', $timestamp); // Outputs '01/01/2021'


// Convert string into timestamp:
$timestamp10 = strtotime('2021-01-01 00:00:00');
echo $timestamp10; // Outputs 1604448000 (timestamp)


$timestamp11 = strtotime('tomorrow');
echo $timestamp11; // Outputs the timestamp for tomorrow

$timestamp12 = strtotime('first day of february');
echo $timestamp12; // Outputs the timestamp for the first day of february

$timestamp13 = strtotime('second wednesday of february');
echo $timestamp13; // Outputs the timestamp for the first day of february

$timestamp14 = strtotime('last day of february');
echo $timestamp14; // Outputs the timestamp for the last day of february

$timestamp15 = strtotime('next friday');
echo $timestamp15; // Outputs the timestamp for the next friday

$timestamp16 = strtotime('last day of february 2020');
echo $timestamp16; // Outputs the timestamp for the last day of february 2020

$timestamp17 = strtotime('last day of february 2020');
echo date('m/d/Y g:ia', $timestamp17);



$date = date('');

var_dump(date_parse($date)); // Outputs an array with information about the date...



// * same as above, but you need to specify the format:
date_parse_from_format('m/d/y g:ia', $date); // Outputs an array with information about the date...