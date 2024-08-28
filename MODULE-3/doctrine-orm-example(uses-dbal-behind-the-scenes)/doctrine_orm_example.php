<?php

use App\Entity\Invoice;
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

    $invoice->getItems()->get(0)->setDescription('Foo bar');

    $invoice->flush();
    // $entityManager->persist($invoiceItem); // This is not needed, because we have 'cascade' set to 'persist' in the 'OneToMany' annotation, in the '$items' property, in the 'Invoice' entity.

    // $invoice->addItem($invoiceItem);
}

// This doesn't actually create data in the database, it just 'queues' the creation of the data, in the database.
$entityManager->persist($invoice);

$entityManager->flush();  // This actually creates the data in the database

// This will 'queue' the deletion of the object/record, but won't actually delete it yet (we need the 'flush()' method)...
$entityManager->remove($invoice);

$entityManager->flush();  // This actually deletes the data in the database

// Get size of the unit of work (the number of objects queued for insertion/deletion):
echo $entityManager->getUnitOfWork()->size();

// Try to find the invoice with id of 15... This invoice/object will be ALREADY IN THE 'managed' state (Which means we don't need to call 'persist()' on it).
$entityManager->find(Invoice::class, 15);
