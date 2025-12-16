<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class saleInvoiceList extends Model
{
    protected $table = 'sale_invoice_lists';

    public function item(){
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
    public function godown()
    {
        return $this->belongsTo(Godown::class, 'godown', 'id');
    }
}
