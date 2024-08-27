<?php

use App\Enums\InvoiceStatus;
use Dotenv\Dotenv;

require_once './vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// var_dump($_ENV);

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
    \Doctrine\ORM\Tools\Setup::createAttributeMetadataConfiguration([__DIR__ . '/src/Entity'], true)
);

$items = [['Item 1', 1, 15], ['Item 2', 2, 7.5], ['Item 3', 4, 3.75]];

$invoice = (new \App\Entity\Invoice())
    ->setAmount(100)
    ->setInvoiceNumber('1')
    ->setStatus(InvoiceStatus::Pending)
    ->setCreatedAt(new \DateTime());

foreach ($items as [$description, $quantity, $unitPrice]) {
    $invoiceItem = (new \App\Entity\InvoiceItem())
        ->setDescription($item[0])
        ->setQuantity($item[1])
        ->setUnitPrice($item[2]);

    $invoice->addItem($invoiceItem);

    // $invoice->addItem($invoiceItem);
}

$entityManager->persist($invoice);
