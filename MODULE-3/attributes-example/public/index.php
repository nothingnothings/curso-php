<?php declare(strict_types=1);

use App\Controllers\GeneratorExampleController;
use App\Controllers\HomeController;
use App\App;
use App\Config;
use App\Container;
use App\Router;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

define('STORAGE_PATH', __DIR__ . '/../storage');
define('VIEW_PATH', __DIR__ . '/../views');

$container = new Container();
$router = new Router($container);

// *  With Attributes feature
$router->registerRoutesFromControllerAttributes([
    HomeController::class,
    GeneratorExampleController::class,
]);

// ! Without Attributes feature
// $router
//     ->get('/', [HomeController::class, 'index'])
//     ->get('/examples/generator', [GeneratorExampleController::class, 'index']);

(new App(
    $container,
    $router,
    ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
    new Config($_ENV)
))->run();
