<?php declare(strict_types=1);

// require_once __DIR__ . './vendor/autoload.php';

require_once './invoice.php';

use App\Invoice;

// $invoice1 = new Invoice();
// $invoice2 = $invoice1;

// unset($invoice1);

// var_dump($invoice2);  // * What happens to invoice2, after unsetting $invoice1?

// * It will keep existing, and the original object, Invoice, will as well. And this is bad for memory handling reasons (because the object won't be garbage collected).

// * This doesn't happen with Weak References; with weak references, if all the strong references to the object are gone (like $invoice2, in this case), the weak references won't stop/prevent the object from being garbage collected.

// * Example of Weak References:
// $invoice = new Invoice();

// $ref = WeakReference::create($invoice);

// var_dump($ref->get()); // * This is how we can get the object, from the weak reference.
// unset($invoice); // * The strong reference is gone, so the object will be garbage collected.
// var_dump($ref->get()); // * The weak reference will return null, because the object will be gone/garbage collected.

//

// * Usage of WeakMaps:
$invoice1 = new invoice();
$map = new WeakMap();  // CREATES A NEW WEAKMAP

$map[$invoice1] = ['a' => 1, 'b' => 2];  // / ASSIGNS THE 'Invoice' object ($invoice1) AS A KEY in the WeakMap, and assign it a value of '['a' => 1, 'b' => 2];'

var_dump($map);  // * Will have the 'Invoice' object as a key, and ['a' => 1, 'b' => 2] as its value.
// var_dump(count($map));
unset($invoice1);  // * Will destroy the object and the strong reference to it.
var_dump($map);  // * will print an empty '$map' object ('{}'), because the object is gone, and the key value (the object as well) is gone with it. The value of the key-value pair also will be gone.
