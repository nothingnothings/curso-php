<?php declare(strict_types=1);

namespace App\Controllers;

use App\Attributes\Get;
use App\Enums\InvoiceStatus;
use App\Models\Invoice;
use App\View;

class InvoiceController
{
    #[Get('/invoices')]
    public function index(): View
    {
        // ! Without enums (InvoiceStatus):
        // $invoices = (new Invoice())->all(InvoiceStatus::PAID);

        // ! With enums:

        $status1 = InvoiceStatus::Paid;
        $status2 = InvoiceStatus::Paid;

        var_dump($status1 === $status2);  // This will return true (same object, in memory, due to enum objects/cases being singletons).

        $invoices = (new Invoice())->all(InvoiceStatus::Paid);

        // * Returns an array with all possible cases (enum case objects).
        // $allPossibleCases = InvoiceStatus::cases();

        return View::make('invoices.index', $invoices);
    }
}
