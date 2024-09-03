<?php declare(strict_types=1);

use Dotenv\Dotenv;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../configs/path_constants.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// ! Create Container, using PHP-DI (without custom bindings):
// $container = new DIContainer();

// * Create Container, using PHP-DI (with custom bindings):
$container = require CONFIG_PATH . '/container.php';

AppFactory::setContainer($container);

// * Import the outsourced router:
$router = require CONFIG_PATH . '/routes.php';

$app = AppFactory::create();

// * Set the outsourced router, with the routes, on the app:
$router($app);

// Add Twig-View Middleware:
$app->add(TwigMiddleware::create($app, $container->get(Twig::class)));  // Twig is obtained from the container.

$app->run();
