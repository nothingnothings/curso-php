<?php


declare(strict_types=1);

namespace App\Models;

use App\Model;

class InvoiceItem extends Model
{
    protected $table = 'invoice_items'; // used if you want to define the corresponding table name explicitly

    public $timestamps = false;


}
