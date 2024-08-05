<?php


use App2\Toaster;
use App2\ToasterPro;


require '../../src/vendor/autoload.php'; // imports the composer's autoloader


$toaster = new Toaster();


$toaster->addSlice('bread');
$toaster->addSlice('bread'); // Only two slices will be toasted, because the limit is 2 in the method.
$toaster->addSlice('bread');
$toaster->addSlice('bread');
$toaster->toast();


echo 'SPACE' . PHP_EOL;

$toasterPro = new ToasterPro();

$toasterPro->addSlice('bread');
$toasterPro->addSlice('bread'); // four slices will be toasted, because the limit is 4, in the case of this child class.
$toasterPro->addSlice('bread');
$toasterPro->addSlice('bread');
$toasterPro->toast();
echo 'SPACE' . PHP_EOL;
$toasterPro->toastBagel();




// '$this' variable behavior, inside of the called method:
$toaster->addSlice('bread'); // '$this', inside of this method, will refer to the PARENT class...
$toasterPro->addSlice('bread'); // '$this', inside of this method, will refer to the CHILD class...