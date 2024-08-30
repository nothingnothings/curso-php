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

$queryBuilder = $entityManager->createQueryBuilder();

// * This won't return the entity object itself, but a simple array with the desired data (from the created_at and amount fields).
$simpleQuery = $queryBuilder
    ->select('i.created_at', 'i.amount')
    ->from(Invoice::class, 'invoice')
    ->where('i.amount > :amount')
    ->setParameter('amount', 100)
    ->orderBy('i.created_at', 'desc')
    ->getQuery();  // * This is needed to create the query object.

echo $simpleQuery->getDQL();  // * This is needed to get the DQL (doctrine query language) query, to check it out.

echo $simpleQuery->getSQL();  // * This is needed to get the SQL query, to check it out.

// ? This is optional (if you want to create the query using DQL strings, taken from getDQL(), from scratch)
// $query = $entityManager->createQuery(' SELECT i.createdAt, i.amount FROM App\Entity\Invoice i WHERE i.amount > :amount ORDER BY i.createdAt');

$invoices = $simpleQuery->getResult();  // * This is needed to execute the query.

var_dump($invoices);

// ->where('invoice.status = :status')
// ->setParameter('status', InvoiceStatus::Pending);

// *This will return the entity object itself, because we are selecting the whole entity (with the alias 'i')
// $simpleQuery = $queryBuilder
//     ->select('i')
//     ->from(Invoice::class, 'invoice')
//     ->where('i.amount > :amount')
//     ->setParameter('amount', 100)
//     ->orderBy('i.created_at', 'desc')
//     ->getQuery();  // * This is needed to create the query object.

// $invoices = $simpleQuery->getResult();  // * This is needed to execute the query.

// /** @var Invoice $invoice */
// foreach ($invoices as $invoice) {
//     echo $invoice->getCreatedAt()->format('m/d/Y g:ia')
//         . ', ' . $invoice->getAmount()
//         . ', ' . $invoice->getStatus()->toString();
// }

// $invoices = $query->getArrayResult(); // * If you want to get the result as an array, instead of an object.

// * execute raw SQL query:
// $query = $entityManager->createNativeQuery('SELECT * FROM invoice WHERE amount > :amount ORDER BY created_at DESC');
// $query->setParameter('amount', 100);
// $invoices = $query->getResult();

// How to use conditions in the where clause:

$queryBuilder = $entityManager->createQueryBuilder();

$queryBuilder
    ->select('i')
    ->from(Invoice::class, 'i')
    ->where('i.amount > :amount')
    ->andWhere('i.status = :status')
    ->orWhere('i.createdAt = :date')
    ->setParameter('amount', 100)
    ->setParameter('status', InvoiceStatus::Pending)
    ->setParameter('date', '2022-01-01 00:00:00')
    ->orderBy('i.created_at', 'desc')
    ->getQuery();

// * Using complex where clauses, with custom expressions:
$queryBuilder
    ->select('i')
    ->from(Invoice::class, 'i')
    ->where(
        $queryBuilder
            ->expr()
            ->andX(
                $queryBuilder->expr()->gt('i.amount', ':amount'),
                $queryBuilder->expr()->orX(
                    $queryBuilder->expr()->eq('i.status', ':status'),
                    $queryBuilder->expr()->gte('i.createdAt', ':date'),
                )
            )
    )
    ->setParameter('amount', 100)
    ->setParameter('status', InvoiceStatus::Pending)
    ->setParameter('date', '2022-01-01 00:00:00')
    ->orderBy('i.created_at', 'desc')
    ->getQuery();

// * Using complex where clauses, with custom expressions and JOINS:
$queryBuilder
    ->select('i', 'it')
    ->from(Invoice::class, 'i')
    ->join('i.items', 'it')  // * 'it' is the alias for the invoiceItems table.
    ->where(
        $queryBuilder
            ->expr()
            ->andX(
                $queryBuilder->expr()->gt('i.amount', ':amount'),
                $queryBuilder->expr()->orX(
                    $queryBuilder->expr()->eq('i.status', ':status'),
                    $queryBuilder->expr()->gte('i.createdAt', ':date'),
                )
            )
    )
    ->setParameter('amount', 100)
    ->setParameter('status', InvoiceStatus::Pending)
    ->setParameter('date', '2022-01-01 00:00:00')
    ->orderBy('i.created_at', 'desc')
    ->getQuery();

// --> ALÉM DE QUERY BUILDING ABILITIES,

// PODEMOS CHAMAR CONNECTION METHODS NO 'entityManager',

// coisas como

// 'beginTransaction',

// 'commit' e

// 'rollback'...

// --> TIPO ASSIM:

$entityManager->getConnection()->beginTransaction();

// OU

$entityManager->getConnection()->commit();

// OU

$entityManager->getConnection()->rollback();

// OU

$entityManager->getConnection()->transactional();

// --> OU, ENTÃO,
//     PODEMOS CHAMAR OS 'TRANSACTION RELATED METHODS'

//     DIRETAMENTE NO ENTITYMANAGER,

//     TIPO ASSIM:

$entityManager->beginTransaction();

$entityManager->commit();

$entityManager->rollback();

$entityManager->wrapInTransaction(function () {});  // * This is the same as 'transactional'
