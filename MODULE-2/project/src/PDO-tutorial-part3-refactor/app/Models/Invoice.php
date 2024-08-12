<?php

declare(strict_types=1);
namespace App30\Models;


// the `Model` base model will have the $db property, which will be used to execute the queries/statements.
class Invoice extends \App30\Models\Model
{


    public function __construct()
    {

    }

    // Will return the id of the invoice
    public function create(float $amount, int $userId): int
    {
        $stmt = $this->db->prepare('INSERT INTO invoices (amount, user_id) VALUES (?, ?)');

        $stmt->execute([$amount, $userId]);

        return (int) $this->db->lastInsertId();
    }


    public function find(int $invoiceId): array
    {
        $stmt = $this->db->prepare('SELECT invoices.id, amount, full_name FROM invoices
         LEFT JOIN users ON users.id = invoices.user_id
         WHERE invoices.id = ?'
        );
        $stmt->execute([$invoiceId]);

        $invoice = $stmt->fetch();

        return $invoice ?? [];
    }
}