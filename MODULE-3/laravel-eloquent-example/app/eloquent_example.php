<?php declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../eloquent.php';


// \Illuminate\Database\Capsule\Manager::connection(); // This provides us access to the database connection, which is used by the Eloquent ORM. We can use it to call rollback(), commit() and 'transaction()' (which works like transactional, will run a closure, everything inside of it, commit if everything goes right, and rollback if something goes wrong).




\Illuminate\Database\Capsule\Manager::connection()->transaction(function() {

    $invoice = new \App\Models\Invoice();

    $invoice->amount = 45;
    $invoice->invoice_number = '1';
    $invoice->status = \App\Enums\InvoiceStatus::Pending;
    // $invoice->due_date = new \DateTime('2023-01-01'); // without Carbon.
    $invoice->due_date = (new \Carbon\Carbon())->addDays(10);
    $invoice->save();

    $items = [['Item 1', 1, 15] , ['Item 2', 2, 20], ['Item 3', 3, 25]];

    foreach($items as [$description, $quantity, $unitPrice]) {
        $item = new \App\Models\InvoiceItem();
        $item->description = $description;
        $item->quantity = $quantity;
        $item->unit_price = $unitPrice;
        // $item->invoice_id = $invoice->id; // Instead of doing it like this, manually, use the 'associate' method, inside the object you want to relate this item to, as seen below, with 'associate()':
        $item->invoice()->associate($invoice);
        $item->save();
    }
});



// $invoice = new \App\Models\Invoice();


// $invoice->amount = 45;
// $invoice->invoice_number = '1';
// $invoice->status = \App\Enums\InvoiceStatus::Pending;
// // $invoice->due_date = new \DateTime('2023-01-01'); // without Carbon.
// $invoice->due_date = (new \Carbon\Carbon())->addDays(10);



// $invoice->save();



// $items = [['Item 1', 1, 15] , ['Item 2', 2, 20], ['Item 3', 3, 25]];

// foreach($items as [$description, $quantity, $unitPrice]) {
//     $item = new \App\Models\InvoiceItem();
//     $item->description = $description;
//     $item->quantity = $quantity;
//     $item->unit_price = $unitPrice;

//     // $item->invoice_id = $invoice->id; // Instead of doing it like this, manually, use the 'associate' method, inside the object you want to relate this item to, as seen below, with 'associate()':
//     $item->invoice()->associate($invoice);

//     $item->save();
// }


