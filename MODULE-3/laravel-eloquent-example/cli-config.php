


<?php

require 'vendor/autoload.php';

use Doctrine\DBAL\DriverManager;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\ORM\Tools\Setup;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = new PhpFile('migrations.php');  // Or use one of the Doctrine\Migrations\Configuration\Configuration\* loaders

$params = [
    'dbname' => $_ENV['DB_DATABASE'],
    'user' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
    'host' => $_ENV['DB_HOST'],
    'driver' => $_ENV['DB_DRIVER'] ?? 'pdo_mysql',
    'port' => $_ENV['DB_PORT'] ?? 3307,
];

$entityManager = \Doctrine\ORM\EntityManager::create(
    $params,
    \Doctrine\ORM\Tools\Setup::createAttributeMetadataConfiguration([__DIR__ . '/app/Entities'], true)
);

$paths = [__DIR__ . '/App/Entity'];
$isDevMode = true;

$ORMConfig = Setup::createAttributeMetadataConfiguration($paths, $isDevMode);
$connection = DriverManager::getConnection(['driver' => 'pdo_sqlite', 'memory' => true]);

return DependencyFactory::fromEntityManager($config, new ExistingEntityManager($entityManager));
