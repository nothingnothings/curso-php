<?php



require '../../src/vendor/autoload.php'; // imports the composer's autoloader



$dateTime = new DateTime(); // create a new DateTime object. First argument is the date/time, second argument is the timezone


var_dump($dateTime);


$dateTime->setTimezone(new DateTimeZone('Europe/Amsterdam')); // set the timezone, inside of the dateTime object/value.


var_dump($dateTime);


// The format() method is used to format the date/time value, and returns a string.
echo $dateTime->format('m/d/Y g:i A') . PHP_EOL;



// the getTimezone() method is used to get the timezone object, and returns a DateTimeZone object. With this object, we can call the getName() method, which returns the name of the timezone.
echo $dateTime->getTimezone()->getName();


// Set the date of the DateTime object, on the fly, during runtime. Then, set the time of the DateTime object, on the fly, during runtime (set it to 12:35:20 AM)
$dateTime->setDate(2021, 4, 21)->setTime(12, 35, 20);


// Format the DateTime object, and return it as string
echo $dateTime->format('m/d/Y g:i A') . PHP_EOL;




// This is totally different from using '/' as a delimiter, because it will not consider the US date format (which is 'm/d/Y')
$date2 = '30.05.2021 3:30PM';

$dateTime2 = new DateTime($date2);

var_dump($dateTime2);







// This is better than using '.' and '-', it's safer (with this ::createFromFormat() method)
$date3 = '30-05-2021 3:30PM';
$dateTime3 = DateTime::createFromFormat('d-m-Y g:iA', $date3)->setTime(0, 0); //set the time as midnight
var_dump($dateTime3);




// Comparisons with DateTime objects:
$dateTime1 = new DateTime('05/25/2021 9:15 AM');
$dateTime2 = new DateTime('05/25/2021 9:14 AM');

var_dump($dateTime1 < $dateTime2);
var_dump($dateTime1 > $dateTime2);
var_dump($dateTime1 == $dateTime2);
var_dump($dateTime1 <=> $dateTime2);



// Comparisons using diff() method:
$dateTime3 = new DateTime('05/25/2021 9:15 AM');
$dateTime4 = new DateTime('03/15/2021 3:25 AM');

var_dump($dateTime3->diff($dateTime4));


var_dump($dateTime3->diff($dateTime4)->days);
var_dump($dateTime3->diff($dateTime4)->format('%Y years, %m months, %d days, %H, %i, %s')) . PHP_EOL;





// Creating a DateInterval object:
$interval = new DateInterval('P2D'); // Interval of 2 days
$interval2 = new DateInterval('PT1H30M'); // Interval of 1 hour and 30 minutes


var_dump($interval);
var_dump($interval2);





// How to use DateInterval to add a time to a DateTime object:
$dateTime = new DateTime('05/25/2021 9:15 AM');
$intervalNew = new DateInterval('P3M2D');

// add method, in DateTime object, uses dateInterval object as argument
$dateTime->add($intervalNew);


echo $dateTime->format('m/d/Y g:iA') . PHP_EOL;


// sub method, in DateTime object, uses dateInterval object as argument, and subtracts the time from the DateTime object
$dateTime->sub($intervalNew);

echo $dateTime->format('m/d/Y g:iA') . PHP_EOL;












// 'from' is current Date, and 'to' is the date one month from the current date.
// $from = new DateTime();
// $to = (clone $from)->add(new DateInterval('P1M'));

// echo $from->format('m/d/Y') . ' - ' . $to->format('m/d/Y') . PHP_EOL;






// * ALTERNATIVE (and more consise) WAY TO DO THE SAME THING (with DateTimeImmutable objects, instead of clone):
$from = new DateTimeImmutable();
$to = $from->add(new DateInterval('P1M'));

echo $from->format('m/d/Y') . ' - ' . $to->format('m/d/Y') . PHP_EOL;

