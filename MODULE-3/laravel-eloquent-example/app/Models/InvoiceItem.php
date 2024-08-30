<?php


declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * @property int $id 
 * @property int $invoice_id
 * @property string $description
 * @property int $quantity
 * @property float $unit_price
 */
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
