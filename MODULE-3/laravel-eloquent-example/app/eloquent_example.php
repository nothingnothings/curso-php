<?php declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '../eloquent.php';




$invoice = new \App\Models\Invoice();


$invoice->amount = 45;
$invoice->invoice_number = '1';
$invoice->status = \App\Enums\InvoiceStatus::Pending;
// $invoice->due_date = new \DateTime('2023-01-01'); // without Carbon.
$invoice->due_date = (new \Carbon\Carbon())->addDays(10);