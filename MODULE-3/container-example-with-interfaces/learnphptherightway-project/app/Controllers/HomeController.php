<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Container;
use App\Services\InvoiceService;
use App\View;

class HomeController
{
    public function __construct(private InvoiceService $invoiceService)
    {

    }

    public function index(): View
    {
        // * Example of how to use the 'InvoiceService' from the container (calling method from the InvoiceService class):
        // ! This example is WITHOUT AUTOWIRING
        // \App\App::$container->get(InvoiceService::class)->process([], 25);


        // * Example of container access, but with autowiring:
        // (new Container())->get(InvoiceService::class)->process([], 25);

        // * Example of the 'InvoiceService' being passed from the container, from the router (IDEAL):
        $this->invoiceService->process([], 25);


        return View::make('index');
    }
}
