<?php declare(strict_types=1);

namespace App\Models;

use App\Enums\InvoiceStatus;
use Illuminate\Database\Eloquent\Model;

// * Doc blocks should be provided, with your Eloquent Models, to generate better autocomplete for your fellow developers (and yourself):

/**
 * @property int $id
 * @property string $invoice_number
 * @property float $amount
 * @property InvoiceStatus  $status
 * @property Carbon $created_at
 * @property Carbon $due_date
 *
 * @property-read Collection $items
 */
class Invoice extends Model
{
    // * This is used if you want the values returned by these models to be cast/transformed to specific types.
    protected $casts = [
        'created_at' => 'datetime',
        'due_date' => 'datetime',
        'status' => InvoiceStatus::class
    ];

    protected $table = 'invoices';  // used if you want to define the corresponding table name explicitly

    // protected $primaryKey = 'invoice_uid';  // we define a 'primaryKey' property if we want to use a field that isn't 'ID' as the primary key of this specific table.

    // public $incrementing = false;  // we define this property to tell Laravel that we don't want to use the auto-incrementing feature of the database, with our keys

    // protected $keyType = 'string';  // we define this property to tell Laravel that we want to use a string as the type of the primary key of this specific table.

    public $timestamps = false;  // we define this property to tell Laravel that we don't want to use the timestamps feature (created_at and updated_at) of the database

    public function __construct() {}

    // const CREATED_AT = 'created_date';  // we define a 'created_at' property if we want to use a field that isn't 'created_at' as the column name of the 'created_at' column of this specific table.

    const UPDATED_AT = null;  // we define a 'updated_at' property as null if we don't want to use/don't have a field that isn't 'updated_at' as the column name of the 'updated_at' column of this specific table.

    // * This is what sets the relation between the Invoice and the InvoiceItem
    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
