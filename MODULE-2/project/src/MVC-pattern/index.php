<?php



declare(strict_types=1);


namespace App21;


require_once __DIR__ . "/../vendor/autoload.php"; // imports the composer's autoloader


session_start();

define('STORAGE_PATH', __DIR__ . '/../storage');
define('VIEW_PATH', __DIR__ . '/../views');


$router = new Router();


$router->get('/', [\App21\Controllers\HomeController::class, 'index'])
    ->post('/upload', [\App21\Controllers\HomeController::class, 'upload'])
    ->get('/invoices', [\App21\Controllers\InvoiceController::class, 'index'])
    ->get('/invoices/create', [\App21\Controllers\InvoiceController::class, 'create'])
    ->post('invoices/create', [\App21\Controllers\InvoiceController::class, 'store']);




echo $router->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));
