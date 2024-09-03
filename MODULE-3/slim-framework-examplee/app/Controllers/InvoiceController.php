<?php declare(strict_types=1);

namespace App\Controllers;

use App\Services\InvoiceService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

// ! Without slim framework + twig (only twig + a custom router implementation)
// class InvoiceController
// {
//     // Twig must be made available in our controllers, through the laravel container.
//     public function __construct(MailerInterface $mailer, private Twig $twig) {}

//     #[Get('/invoices')]
//     public function index(): string
//     {
//         $invoices = Invoice::query()->where('status', InvoiceStatus::Paid)->get()->toArray();

//         // return View::make('invoices/index', ['invoices' => $invoices]); // ! Without twig templating engine

//         return $this->twig->render('invoices/index.twig', ['invoices' => $invoices]);  // * With twig templating engine
//     }

//     #[Get('/invoices/new')]
//     public function create()
//     {
//         $invoice = new Invoice();

//         $invoice->invoice_number = 5;
//         $invoice->amount = 20;
//         $invoice->status = InvoiceStatus::Pending;
//         $invoice->due_date = (new Carbon())->addDay();

//         $invoice->save();

//         echo $invoice->id . ', ' . $invoice->due_date->format('m/d/Y');
//     }
// }

// * With slim framework + twig component (slim's twig component)
class InvoiceController
{
    public function __construct(private InvoiceService $invoiceService) {}

    public function index(Request $request, Response $response, $args): Response
    {
        $invoices = $this->invoiceService->getPaidInvoices();

        return Twig::fromRequest($request)->render($response, 'invoices/index.twig', ['invoices' => $invoices]);
    }

    public function create() {}
}
