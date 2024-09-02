<?php declare(strict_types=1);

namespace App\Controllers;

use App\Attributes\Get;
use App\Enums\InvoiceStatus;
use App\Models\Invoice;
use App\View;
use Carbon\Carbon;
use Symfony\Component\Mailer\MailerInterface;
use Twig\Environment as Twig;

class InvoiceController
{
    public function __construct(MailerInterface $mailer, private Twig $twig) {}

    #[Get('/invoices')]
    public function index(): string
    {
        $invoices = Invoice::query()
            ->where('status', InvoiceStatus::Paid)
            ->get()
            ->map(
                fn(Invoice $invoice) => [
                    'invoice_number' => $invoice->invoice_number,
                    'amount' => $invoice->amount,
                    'status' => $invoice->status->toString(),
                    'dueDate' => $invoice->due_date->toDateTimeString()
                ]
            )
            ->toArray();

        var_dump($invoices);

        return $this->twig->render('invoices/index.twig', ['invoices' => $invoices]);  // * With twig templating engine
    }

    #[Get('/invoices/new')]
    public function create()
    {
        $invoice = new Invoice();

        $invoice->invoice_number = 5;
        $invoice->amount = 20;
        $invoice->status = InvoiceStatus::Pending;
        $invoice->due_date = (new Carbon())->addDay();

        $invoice->save();

        echo $invoice->id . ', ' . $invoice->due_date->format('m/d/Y');
    }
}