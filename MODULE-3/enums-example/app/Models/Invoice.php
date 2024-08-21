<?php declare(strict_types=1);

namespace App\Models;

use App\Enums\InvoiceStatus;
use App\Model;
use PDO;

class Invoice extends Model
{
    // ! Without enums (no typehinting):
    // public function all(int $status): array

    // * With enums (with enum typehinting):
    public function all(InvoiceStatus $status): array
    {
        // ! Without enums (InvoiceStatus):
        // if (!in_array($status, InvoiceStatus::all())) {
        //     throw new \InvalidArgumentException('Invalid status was passed as an argument');
        // }

        $stmt = $this->db->prepare(
            'SELECT id, invoice_number, amount, status
             FROM invoices
             WHERE status = ?'
        );

        // ! Without enums:
        // $stmt->execute([InvoiceStatus::PAID]);

        // * With enums:
        // $stmt->execute([$status->name]); // Get the Case's name, with the '->name' method.

        $stmt->execute([$status->value]);  // Get the Case's value, with the '->value' method.

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
