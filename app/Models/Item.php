<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DefineItem;
use App\Models\DefineSize;
use App\Models\Party;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'date',
        'item_code',
        'size_id',
        'barcode',
        'description',
        'purchase_rate',
        'sale_rate',
        'party_discount',
        'margin_field',
        'party_less',
        'customer_less',
        'wholesale_profit',
        'packet_qty',
        'pieces_in_packet',
        'total_pieces',
        'status',
        'retail_sale_rate_p',
        'retail_sale_rate',
        'retail_less',
        'retail_discount',
        'retail_profit',
        'min_level',
        'max_level',
        'w_sale_man_commension',
        'r_sale_man_commension',
        'define_item_id',
        'define_size_id',
        'party_id',
        'image',
        'file',
        'whatsapp_file',
    ];

    public function party(){
        return $this->belongsTo(Party::class);
    }

    public function define_item(){
        return $this->belongsTo(DefineItem::class);
    }

    public function define_size(){
        return $this->belongsTo(DefineSize::class);
    }

}
