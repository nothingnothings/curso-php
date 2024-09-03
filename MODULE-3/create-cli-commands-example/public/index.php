<?php declare(strict_types=1);

use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../configs/path_constants.php';

// * Import the boostrapped app:
$app = require __DIR__ . '/../bootstrap.php';

// * Get the container from the app variable (thanks to PHP DI, method getContainer()):
$container = $app->getContainer();

// * Import the outsourced router:
$router = require CONFIG_PATH . '/routes.php';

// * Set the outsourced router, with the routes, on the app:
$router($app);

// Add Twig-View Middleware:
$app->add(TwigMiddleware::create($app, $container->get(Twig::class)));  // Twig is obtained from the container.

$app->run();
