<?php declare(strict_types=1);

use App\Controllers\HomeController;
use App\Controllers\InvoiceController;
use App\Config;
use DI\Container as DIContainer;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Dotenv\Dotenv;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Twig\Extra\Intl\IntlExtension;

require_once __DIR__ . '/../vendor/autoload.php';

define('STORAGE_PATH', __DIR__ . '/../storage');
define('VIEW_PATH', __DIR__ . '/../views');

var_dump(__DIR__);

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// Create Container, using PHP-DI:
$container = new DIContainer();

// bind Config to container:
$container->set(Config::class, \DI\create(Config::class)->constructor($_ENV));

// bind EntityManager to container:
$container->set(EntityManager::class, fn(Config $config) => EntityManager::create(
    $config->db,
    ORMSetup::createAttributeMetadataConfiguration([__DIR__, './../app/Entity'])
));

// Set container to create App with on AppFactory:
AppFactory::setContainer($container);

$app = AppFactory::create();

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
