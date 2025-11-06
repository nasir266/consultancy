<?php

namespace App\Http\Controllers;

use App\Models\DefineItem;
use App\Models\DefineSize;
use App\Models\Godown;
use App\Models\Item;
use App\Models\ItemInvoice;
use App\Models\Party;
use App\Models\salesman;
use Illuminate\Http\Request;

class saleController extends Controller
{
    public function index(){
        $id = ItemInvoice::latest('id')->value('id');
        $parties = Party::all();

        $bill_no = ItemInvoice::latest('id')->value('bill_no') + 1 ?? 1;
        $vr_no = ItemInvoice::latest('id')->value('vr_no') + 1 ?? 1;
        $party_inv_no = ItemInvoice::latest('id')->value('party_inv_no');
        if((int)$party_inv_no == 0){
            $party_inv_no = 1;
        }else{
            $party_inv_no = $party_inv_no + 1;
        }
        $bilty_no = ItemInvoice::latest('id')->value('bilty_no');
        if((int)$bilty_no == 0){
            $bilty_no = 1;
        }else{
            $bilty_no = (int)$bilty_no + 1;
        }
        $search_names = Party::pluck("name");
        $search = Party::with("party_mobiles")->get();
        $items = Item::orderBy("id","DESC")->get();

        $search_barcodes = Item::pluck("barcode");
        $search_pic = Item::pluck("item_code");
        $search_purchase_rate = Item::pluck("purchase_rate");

        $goddown = Godown::all();
        $salesmans = salesman::all();
        $search_define_items = DefineItem::whereIn("id", $items->pluck("define_item_id"))->get();
        $search_define_sizes = DefineSize::whereIn("id", $items->pluck("define_size_id"))->get();
        return view("admin.sale-invoice.sale-invoice")->with(['bill_no' => $bill_no, "search_barcodes" =>$search_barcodes, "search_pic" => $search_pic, "search_purchase_rate" => $search_purchase_rate, "search_define_items" => $search_define_items ,"search_define_sizes" => $search_define_sizes, 'parties' => $parties, 'items'=>$items, 'vr_no' => $vr_no, 'search_names' => $search_names, 'search' => $search, 'bilty_no' => $bilty_no, 'party_inv_no'=>$party_inv_no, 'godown'=>$goddown, 'salesmans' => $salesmans]);
    }
}
