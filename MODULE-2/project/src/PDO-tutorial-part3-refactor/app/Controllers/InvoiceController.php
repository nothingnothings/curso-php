<?php

declare(strict_types=1);


namespace App30\Controllers;

use App30\View;


class InvoiceController
{

    public function index(): View
    {

        return View::make('invoices/index');
    }

    public function create(): View
    {
        return View::make('invoices/create');
    }

    public function store(): void
    {
        // $invoice = new Invoice();

        $amount = $_POST['amount'];

        var_dump($amount);
    }
}

