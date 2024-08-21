<?php declare(strict_types=1);

namespace App\Models;

use App\Model;

class Invoice extends Model
{
    public function all(): array
    {
        $stmt = $this->db->query(
            'SELECT id, invoice_number, amount, status FROM invoices'
        );

        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }
}
