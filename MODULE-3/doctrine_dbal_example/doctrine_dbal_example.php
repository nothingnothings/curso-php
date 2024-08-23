<?php

use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Connection;
use Dotenv\Dotenv;

require_once './vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// var_dump($_ENV);

$connectionParams = [
    'dbname' => $_ENV['DB_DATABASE'],
    'user' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
    'host' => $_ENV['DB_HOST'],
    'driver' => $_ENV['DB_DRIVER'] ?? 'pdo_mysql',
    'port' => $_ENV['DB_PORT'] ?? 3307,
];

$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);

$stmt = $conn->prepare('SELECT * FROM INVOICES');

$result = $stmt->executeQuery();

var_dump($result->fetchAllAssociative());

// * Execute the query directly, without preparing:
$result = $conn->executeQuery('SELECT * FROM INVOICES;');
var_dump($result->fetchAllAssociative());

// * With WHERE clause usage:
$stmt2 = $conn->prepare('SELECT * FROM INVOICES;');
$result2 = $stmt2->executeQuery();
var_dump($result2->fetchAssociative());

// ! this DOES NOT WORK (bugged) - With named parameters usage, without binds (does not always work):
// $stmt3 = $conn->prepare('SELECT * FROM INVOICES WHERE id = :id');
// $result3 = $stmt3->executeQuery([':id' => 3]);
// var_dump($result3->fetchAssociative());

// * With named parameters usage and BINDING parameters (this always works):
$stmt4 = $conn->prepare('SELECT * FROM INVOICES WHERE id = :id');
$stmt4->bindValue('id', 3);
$result4 = $stmt4->executeQuery();
var_dump($result4->fetchAssociative());

// * Inserting data, with executeStatement method (works):
// $stmt5 = $conn->prepare('INSERT INTO INVOICES (id, name, amount) VALUES (:name, :amount);');
// $stmt5->bindValue('name', 'John Doe');
// $stmt5->bindValue('amount', 100);
// $stmt5->executeStatement();

// * Using the TYPE CONVERSION feature of DBAL:
$stmt6 = $conn->prepare('SELECT * FROM INVOICES WHERE created_at BETWEEN :fromDate AND :toDate');

// you need to pass the third parameter, indicating the object type, for this to work.
$stmt6->bindValue(':fromDate', new \DateTime('2022-01-01'), 'datetime');
$stmt6->bindValue(':toDate', new \DateTime('2022-12-31'), 'datetime');

// * Working with lists of values (works):
$ids = [1, 2, 3, 4, 5];

$stmt7 = $conn->executeQuery('SELECT * FROM INVOICES WHERE id IN (?)', [$ids], array(\Doctrine\DBAL\Connection::PARAM_INT_ARRAY));
$result = $stmt7->fetchAllAssociative();

// Transactions work exactly like with PDO:

$conn->beginTransaction();
try {
    echo 'ENTERED';
    $stmt8 = $conn->prepare('INSERT INTO users (email, full_name, is_active, created_at) VALUES (:email, :full_name, :is_active, :created_at);');
    $stmt8->bindValue('email', 'john@doe.com');
    $stmt8->bindValue('full_name', 'John Doe');
    $stmt8->bindValue('is_active', true);
    $stmt8->bindValue('created_at', new \DateTime('2022-01-01'), 'datetime');
    $result = $stmt8->executeStatement();

    $conn->commit();
    var_dump($result);
} catch (\Exception $e) {
    var_dump($e->getMessage());
    echo 'ENTERED2';
    $conn->rollBack();
}

// * Instead of writing raw queries, we can use DBAL's query builder, like this (works like knex or sequelize):
$builder = $conn->createQueryBuilder();

$invoices = $builder
    ->select('id', 'amount')
    ->from('invoices')
    ->where('amount > ?')
    // ->join()
    // ->groupBy()
    // ->having()
    ->setParameter(0, 6000)  // positional parameter, and then the VALUE.
    ->execute()
    ->fetchAllAssociative();

var_dump($invoices);

// the schema manager is a great tool for getting information about the database schema, and for creating tables, etc.
$schema = $conn->getSchemaManager();

var_dump($schema->listTableNames());

var_dump($schema->listTableColumns('invoices'));

var_dump(
    array_keys(
        $schema->listTableColumns('invoices')
    )
);

var_dump(
    array_map(fn(Column $column) => $column->getName(), $schema->listTableColumns('invoices'))
);
