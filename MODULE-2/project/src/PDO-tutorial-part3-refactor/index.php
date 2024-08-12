<?php



declare(strict_types=1);


namespace App30;


require_once __DIR__ . "/../vendor/autoload.php"; // imports the composer's autoloader


$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

define('STORAGE_PATH', __DIR__ . '/../storage');
define('VIEW_PATH', __DIR__ . '/../views');

$config = new \App30\Config\Config($_ENV);

$router = new Router();

$router->get('/', [\App30\Controllers\HomeController::class, 'index'])
    ->post('/upload', [\App30\Controllers\HomeController::class, 'upload'])
    ->get('/invoices', [\App30\Controllers\InvoiceController::class, 'index'])
    ->get('/invoices/create', [\App30\Controllers\InvoiceController::class, 'create'])
    ->post('invoices/create', [\App30\Controllers\InvoiceController::class, 'store']);



// (
//     new App(
//         $router,
//         ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
//         [
//             'driver' => $_ENV['DB_DRIVER'],
//             'host' => $_ENV['DB_HOST'],
//             'database' => $_ENV['DB_DATABASE'],
//             'user' => $_ENV['DB_USER'],
//             'password' => $_ENV['DB_PASSWORD'],
//         ]
//     )
// )->run();



(
    new App(
        $router,
        ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
        $config
    )
)->run();