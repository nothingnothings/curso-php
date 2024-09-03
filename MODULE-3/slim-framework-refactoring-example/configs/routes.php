<?php declare(strict_types=1);

use App\Controllers\HomeController;
use App\Controllers\InvoiceController;
use Slim\App;

// * Using a closure to access the 'app' variable, to then register the routes:
return function (App $app) {
    $app->get(
        '/',
        [HomeController::class, 'index']  // with this, we fire this method/render this 'index' view, upon this route being reached.
    );

    $app->get(
        '/invoices',
        [InvoiceController::class, 'index']  // with this, we fire this method/render this 'index' view, upon this route being reached.
    );
};
