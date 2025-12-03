<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\DefineItem;
use App\Models\DefineSize;
use App\Models\Godown;
use App\Models\invoice_comment;
use App\Models\Item;
use App\Models\ItemInvoice;
use App\Models\ItemInvoiceList;
use App\Models\Party;
use Illuminate\Http\Request;
use App\Models\salesman;
use Illuminate\Support\Facades\DB;

class purchaseController extends Controller
{
    public function index(){
        $id = ItemInvoice::latest('id')->value('id');
        $parties = Party::all();

        $bill_no = ItemInvoice::latest('id')->value('bill_no') + 1 ?? 1;
        $vr_no = ItemInvoice::latest('id')->value('vr_no') + 1 ?? 1;
        $party_inv_no = ItemInvoice::latest('id')->value('party_inv_no');
        /*if((int)$party_inv_no == 0){
            $party_inv_no = 1;
        }else{
            $party_inv_no = $party_inv_no + 1;
        }*/
        $bilty_no = ItemInvoice::latest('id')->value('bilty_no');
        /*if((int)$bilty_no == 0){
            $bilty_no = 1;
        }else{
            $bilty_no = (int)$bilty_no + 1;
        }*/
        $search_names = Party::pluck("name");
        $search = Party::with("party_mobiles")->get();
        $items = Item::orderBy("id","DESC")->get();

        $search_barcodes = Item::pluck("barcode");
        $search_pic = Item::pluck("item_code");
        $search_purchase_rate = Item::pluck("purchase_rate");

        $goddown = Godown::where('default_status', 'default')
            ->orWhere('default_status', 'LIKE', '%PurchaseInvoice%')
            ->get();
        //print_r($goddown);
        //dd();
        $salesmans = salesman::all();
        $search_define_items = DefineItem::whereIn("id", $items->pluck("define_item_id"))->get();
        $search_define_sizes = DefineSize::whereIn("id", $items->pluck("define_size_id"))->get();

        $banks = ItemInvoice::pluck('bank')
            ->merge(ItemInvoice::pluck('bt_to'))
            ->unique()
            ->values()
            ->toArray();
        return view("admin.purchase-invoice.purchase-invoice")->with(['banks' => $banks,'bill_no' => $bill_no, "search_barcodes" =>$search_barcodes, "search_pic" => $search_pic, "search_purchase_rate" => $search_purchase_rate, "search_define_items" => $search_define_items ,"search_define_sizes" => $search_define_sizes, 'parties' => $parties, 'items'=>$items, 'vr_no' => $vr_no, 'search_names' => $search_names, 'search' => $search, 'bilty_no' => $bilty_no, 'party_inv_no'=>$party_inv_no, 'godown'=>$goddown, 'salesmans' => $salesmans]);
    }


    public function getItem($barcode)
    {
        $items = Item::where('barcode', $barcode)->get()->first()   ;
        return response()->json($items);
        //echo $barcode;
    }
    function search_invoice(Request $req){
        $type = $req->type;
        if($type == "bill_no"){
            $get = ItemInvoice::with([
                'item_invoice_lists.item'
            ])
                ->where('bill_no', $req->value)
                ->first();
            $itemInvoiceId = $get->item_invoice_lists->pluck('item_invoice_id')->first();
            //$comment = invoice_comment::where('invoice_id', $itemInvoiceId)->get();
            $comment = invoice_comment::join('users', 'users.id', '=', 'invoice_comment.added_by')
                ->where('invoice_comment.invoice_id', $itemInvoiceId)
                ->select(
                    'invoice_comment.*',
                    'users.name as user_name'
                )
                ->get();
        }elseif ($type == "vr_no"){
            $get = ItemInvoice::with([
                'item_invoice_lists.item'
            ])
                ->where('vr_no', $req->value)
                ->first();
            //$get = ItemInvoice::with("item_invoice_lists.item")->with("godown")->where("",$req->value)->get()->first();
            $itemInvoiceId = $get->item_invoice_lists->pluck('item_invoice_id')->first();
            $comment = invoice_comment::where('invoice_id', $itemInvoiceId)->get();
        }elseif ($type == "bilty_no"){
            $get = ItemInvoice::with([
                'item_invoice_lists.item'
            ])
                ->where('bilty_no', $req->value)
                ->first();
            //$get = ItemInvoice::with("item_invoice_lists.item")->with("godown")->where("bilty_no",$req->value)->get()->first();
            $itemInvoiceId = $get->item_invoice_lists->pluck('item_invoice_id')->first();
            $comment = invoice_comment::where('invoice_id', $itemInvoiceId)->get();
        }elseif ($type == "party_inv_no"){
            $get = ItemInvoice::with([
                'item_invoice_lists.item'
            ])
                ->where('party_inv_no', $req->value)
                ->first();
            //$get = ItemInvoice::with("item_invoice_lists.item")->with("godown")->where("party_inv_no",$req->value)->get()->first();
            $itemInvoiceId = $get->item_invoice_lists->pluck('item_invoice_id')->first();
            $comment = invoice_comment::where('invoice_id', $itemInvoiceId)->get();
        }elseif ($type == "invoice_list"){
            return 'ggg';
            $record = ItemInvoiceList::where('id', $req->value)->first();
            $get_invoice_id = $record->id;
            $get = ItemInvoice::with("item_invoice_lists.item")->with("godown")->where("id",$get_invoice_id)->get()->first();
            $itemInvoiceId = $get->item_invoice_lists->pluck('item_invoice_id')->first();
            $comment = invoice_comment::where('invoice_id', $itemInvoiceId)->get();
        }else{
            $get = '';
            $comment = '';
        }

        return response()->json([
            'invoice' => $get,
            'comments' => $comment,
        ]);
    }

    function add(Request $request){
        /*print_r($request->all());
        die();*/

        try{
            $data = [
                'sal_id' => $request->salesman_id,
                'date' => $request->current_date,
                'bill_no' => $request->bill_no,
                'vr_no' => $request->vr_no,
                'party_inv_date' => $request->party_inv_date,
                'party_inv_no' => $request->party_inv_no,
                'bilty_no' => $request->bilty_no,
                'remarks' => $request->remarks ?? null,
                'pkt_qty' => $request->total_pkt,
                'total_pcs' => $request->total_piec,
                'amount' => $request->total_amount,
                'less' => $request->total_less,
                'g_amount' => $request->total_gamount,
                'inv_disc_perc' => $request->inv_disc_perc,
                'disc_perc' => $request->total_disc,
                'net_amount' => $request->net_amount,
                'freight' => $request->freight,
                'paid_amount' => $request->paid_amount,
                'total_less' => $request->total_less2,
                'total_amount' => $request->total_amount2,
                'payment_status' => $request->payment_status ?? 'unpaid',
                'godown_id' => $request->godown,
                'salesman_id' => $request->salesman_id,
                'cash_amount' => $request->cash_amount,
                'cash_remarks' => $request->cash_remarks,
                'bank' => $request->bank,
                'bank_account_title' => $request->bank_account_title,
                'bank_account_number' => $request->bank_account_number,
                'bank_amount' => $request->bank_amount,
                'bank_remarks' => $request->bank_remarks,
                'cheque_bank' => $request->cheque_bank,
                'cheque_amount' => $request->cheque_amount,
                'cheque_date' => $request->cheque_date,
                'cheque_remarks' => $request->cheque_remarks,
                'bt_from' => $request->bt_from,
                'bt_to' => $request->bt_to,
                'bt_account_title' => $request->bt_account_title,
                'bt_account_number' => $request->bt_account_number,
                'bt_amount' => $request->bt_amount,
                'bt_remarks' => $request->bt_remarks,
                'payment_total_amount' => $request->payment_total_amount,
                'party_id' => $request->party_id,
            ];

            //return $data;

            $record = ItemInvoice::updateOrCreate(
                ['bill_no' => $request->bill_no],
                $data
            );


            if ($request->item_id && !empty($request->item_id)) {
                $existingItemIds = ItemInvoiceList::where('item_invoice_id', $record->id)->pluck('item_id')->toArray();

                $itemsToDelete = array_diff($existingItemIds, $request->item_id);
                if (!empty($itemsToDelete)) {
                    ItemInvoiceList::where('item_invoice_id', $record->id)
                        ->whereIn('item_id', $itemsToDelete)
                        ->delete();
                }

                foreach ($request->item_id as $index => $item_id) {
                    if (!in_array($item_id, $existingItemIds)) {
                        $i = new ItemInvoiceList;
                        $i->item_invoice_id = $record->id;
                        $i->item_id = $item_id;
                        $i->barcode                = $request->invoice_barcode[$index] ?? null;
                        $i->party_item_code        = $request->invoice_party_item_code[$index] ?? null;
                        $i->description            = $request->invoice_description[$index] ?? null;
                        $i->godown                 = $request->invoice_godown[$index] ?? null;
                        $i->packet_qty             = $request->invoice_packet_qty[$index] ?? null;
                        $i->pieces_in_packet       = $request->invoice_pieces_in_packet[$index] ?? null;
                        $i->total_pcs              = $request->invoice_total_pcs[$index] ?? null;
                        $i->purchase_rate          = $request->invoice_purchase_rate[$index] ?? null;
                        $i->amount                 = $request->invoice_amount[$index] ?? null;
                        $i->less_per_pcs           = $request->invoice_less_per_pcs[$index] ?? null;
                        $i->discount_per_pcs       = $request->invoice_discount_per_pcs[$index] ?? null;
                        $i->l_rate                 = $request->invoice_l_rate[$index] ?? null;
                        $i->gross_amount           = $request->invoice_gross_amount[$index] ?? null;
                        $i->total_less             = $request->invoice_total_less[$index] ?? null;
                        $i->total_discount_percent = $request->invoice_total_dis_percent[$index] ?? null;
                        $i->party_less_total       = $request->invoice_party_less_total[$index] ?? null;
                        $i->party_total_discount   = $request->invoice_party_total_discount[$index] ?? null;
                        $i->party_discount         = $request->invoice_party_discount[$index] ?? null;
                        $i->margin                 = $request->invoice_margin[$index] ?? null;
                        $i->total_margin           = $request->invoice_total_margin[$index] ?? null;
                        $i->status                 =  null;

                        $i->save();
                    }
                }
            } else {

                ItemInvoiceList::where('item_invoice_id', $record->id)->delete();

            }

            //return print_r($data);
            //Session::flash("success","Invoice Added Successfuly!");
            return response()->json(['success' => true], 201);
        }catch(Exception $e){
            Session::flash("error",$e->getMessage());
            return redirect("/employee-types/add");
        }
    }

    public function delete_item(Request $request)
    {
        DB::table('item_invoice_lists')
            ->where('id', $request->id)
            ->update(['status' => 1]);
        return response()->json('success');
    }
    public function recover_item(Request $request)
    {
        DB::table('item_invoice_lists')
            ->where('id', $request->id)
            ->update(['status' => 2]);
        return response()->json('success');
    }
   /* public function get_areas($area_id)
    {
        //$areas = Area::where('id', $area_id)->get(['id', 'name']);

        $areas = DB::table('areas AS a')
            ->select('a.name AS area_name', 'a.id AS area_id', 'c.name AS city_name', 'c.id AS city_id')
            ->leftJoin('cities AS c', 'c.id', '=', 'a.city_id')
            ->where('a.id', $area_id)
            ->get()->first();
        return response()->json($areas);
    }*/
    function search_party_id(Request $req){
        $get = Party::with("party_mobiles")->with("party_less")->with("area")->with("area.city")->find($req->value);
        return response()->json($get);
    }
}
