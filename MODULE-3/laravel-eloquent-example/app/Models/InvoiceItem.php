<?php


declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceItem extends Model
{
    protected $table = 'invoice_items'; // used if you want to define the corresponding table name explicitly

    public $timestamps = false;

    // * This is what sets the relation between the Invoice and the InvoiceItem
    public function invoice(): BelongsTo
    {

        return $this->belongsTo(Invoice::class);
    }
}
