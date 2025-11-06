<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ItemInvoiceList;
use App\Models\Godown;

class ItemInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'bill_no',
        'vr_no',
        'party_inv_date',
        'party_inv_no',
        'bilty_no',
        'remarks',
        'pkt_qty',
        'total_pcs',
        'amount',
        'less',
        'g_amount',
        'inv_disc_perc',
        'disc_perc',
        'net_amount',
        'freight',
        'paid_amount',
        'total_less',
        'total_amount',
        'payment_status',
        'godown_id',
        'item_id',
        'cash_amount',
        'cash_remarks',
        'bank',
        'bank_account_title',
        'bank_account_number',
        'bank_amount',
        'bank_remarks',
        'cheque_bank',
        'cheque_amount',
        'cheque_date',
        'cheque_remarks',
        'bt_from',
        'bt_to',
        'bt_account_title',
        'bt_account_number',
        'bt_amount',
        'bt_remarks',
        'payment_total_amount',
        'party_id',
    ];

    public function item_invoice_lists(){
        return $this->hasMany(ItemInvoiceList::class);
    }

    public function godown(){
        return $this->belongsTo(Godown::class);
    }
}
