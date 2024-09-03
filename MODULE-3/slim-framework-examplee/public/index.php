<?php declare(strict_types=1);

use App\Controllers\HomeController;
use App\Controllers\InvoiceController;
use Illuminate\Container\Container as Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Twig\Extra\Intl\IntlExtension;

require_once __DIR__ . '/../vendor/autoload.php';

define('STORAGE_PATH', __DIR__ . '/../storage');
define('VIEW_PATH', __DIR__ . '/../views');

// $container = new Container();

$app = AppFactory::create();

// ? this is the most basic example possible, rendering a page straight from the callback of each route (without controller usage)
// $app->get('/', function (Request $request, Response $response, $args) {
//     // We use this to render a view, from our views folder.
//     $view = Twig::fromRequest($request);

//     return $view->render($response, 'index.twig');  // * 1st parameter is the response psr7 object/interface, second is the actual view to be rendered, and the 3rd (optional) is the DATA to be passed into the view, if you need any.
// });

$app->get(
    '/',
    [HomeController::class, 'index']  // with this, we fire this method/render this 'index' view, upon this route being reached.
);

$app->get(
    '/invoices',
    [InvoiceController::class, 'index']  // with this, we fire this method/render this 'index' view, upon this route being reached.
);

// Create Twig:
$twig = Twig::create(VIEW_PATH, ['cache' => STORAGE_PATH . '/cache', 'auto_reload' => true]);

$twig->addExtension(new IntlExtension());

// Add Twig-View Middleware:
$app->add(TwigMiddleware::create($app, $twig));

$app->run();

// ! THIS WAS OUR CUSTOM IMPLEMENTATION (more basic than the slim framework's one)
// $router = new Router($container);

// $router->registerRoutesFromControllerAttributes(
//     [
//         HomeController::class,
//         InvoiceController::class,
//     ]
// );

// (new App(
//     $container,
//     $router,
//     ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']]
// ))->boot()->run();
