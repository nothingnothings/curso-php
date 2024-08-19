<?php declare(strict_types=1);

namespace App\Controllers;

use App\Attributes\Get;
use App\Attributes\Post;
use App\Attributes\Put;
use App\Attributes\Route;
use App\Services\InvoiceService;
use App\View;

class HomeController
{
    // #[Get('/')]
    // private int $x;

    public function __construct(private InvoiceService $invoiceService) {}

    // #[Route('/')]
    #[Get('/')]
    #[Get('/home')]
    public function index(): View
    {
        $this->invoiceService->process([], 25);

        return View::make('index');
    }

    // #[Route('/', 'post')]
    #[Post('/')]
    public function store() {}

    // #[Route('/update', 'put')]
    #[Put('/')]
    public function update() {}
}
