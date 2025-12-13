<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class ItemInvoiceList extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_invoice_id',
        'item_id',
        'barcode',
        'party_item_code',
        'description',
        'godown',
        'packet_qty',
        'pieces_in_packet',
        'total_pcs',
        'purchase_rate',
        'amount',
        'less_per_pcs',
        'discount_per_pcs',
        'l_rate',
        'gross_amount',
        'total_less',
        'total_discount_percent',
        'party_less_total',
        'party_total_discount',
        'party_discount',
        'margin',
        'total_margin',
        'status'
    ];
    public function item(){
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
    public function godown()
    {
        return $this->belongsTo(Godown::class, 'godown', 'id');
    }
}
