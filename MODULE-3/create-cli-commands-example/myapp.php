<?php

use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\EntityManager;

// replace with path to your own project bootstrap file
// require_once 'bootstrap.php';

$app = require __DIR__ . '/bootstrap.php';
$container = $app->getContainer();

// replace with mechanism to retrieve EntityManager in your app
// $entityManager = GetEntityManager();

$entityManager = $container->get(EntityManager::class);

$commands = [
    // If you want to add your own custom console commands,
    // you can do so here.
];

ConsoleRunner::run(
    new SingleManagerProvider($entityManager),
    $commands
);
