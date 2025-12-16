<?php

namespace App\Http\Controllers;

use App\Models\DefineItem;
use App\Models\DefineSize;
use App\Models\Godown;
use App\Models\invoice_comment;
use App\Models\Item;
use App\Models\ItemInvoiceList;
use App\Models\Party;
use App\Models\saleInvoice;
use App\Models\saleInvoiceList;
use App\Models\salesman;
use Illuminate\Http\Request;
use App\Models\ItemInvoice;
class saleController extends Controller
{
    public function index(){
        $id = saleInvoice::latest('id')->value('id');
        $parties = Party::all();

        $bill_no = saleInvoice::latest('id')->value('bill_no') + 1 ?? 1;
        ///dd($bill_no);
        $vr_no = saleInvoice::latest('id')->value('vr_no') + 1 ?? 1;


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

        $banks = saleInvoice::pluck('bank')
            ->merge(saleInvoice::pluck('bt_to'))
            ->unique()
            ->values()
            ->toArray();
        return view("admin.sale-invoice.sale-invoice")->with(['banks' => $banks,'bill_no' => $bill_no, "search_barcodes" =>$search_barcodes, "search_pic" => $search_pic, "search_purchase_rate" => $search_purchase_rate, "search_define_items" => $search_define_items ,"search_define_sizes" => $search_define_sizes, 'parties' => $parties, 'items'=>$items, 'vr_no' => $vr_no, 'search_names' => $search_names, 'search' => $search, 'godown'=>$goddown, 'salesmans' => $salesmans]);
    }


    function add(Request $request){
        //return print_r($request->all());


        try{
            $data = [
                'date' => $request->current_date,
                'bill_no' => $request->bill_no,
                'vr_no' => $request->vr_no,
                'remarks' => $request->remarks ?? null,
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
                'salesman_id' => $request->salesman,
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


            $record = saleInvoice::updateOrCreate(
                ['bill_no' => $request->bill_no],
                $data
            );

            //return print_r($data);
            //();


            if ($request->item_id && !empty($request->item_id)) {
                $existingItemIds = saleInvoiceList::where('item_invoice_id', $record->id)->pluck('item_id')->toArray();

                $itemsToDelete = array_diff($existingItemIds, $request->item_id);
                if (!empty($itemsToDelete)) {
                    saleInvoiceList::where('item_invoice_id', $record->id)
                        ->whereIn('item_id', $itemsToDelete)
                        ->delete();
                }

                foreach ($request->item_id as $index => $item_id) {
                    if (!in_array($item_id, $existingItemIds)) {
                        $i = new saleInvoiceList;
                        $i->item_invoice_id = $record->id;
                        $i->item_id = $item_id;
                        $i->barcode                = $request->invoice_barcode[$index] ?? null;
                        $i->description            = $request->invoice_description[$index] ?? null;
                        $i->godown                 = $request->invoice_godown[$index] ?? null;
                        $i->total_pcs              = $request->invoice_total_pcs[$index] ?? null;
                        $i->sale_rate          = $request->invoice_purchase_rate[$index] ?? null;
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
                        $i->status                 =  null;

                        $i->save();
                    }
                }
            } else {

                saleInvoiceList::where('item_invoice_id', $record->id)->delete();

            }

            //return print_r($data);
            //Session::flash("success","Invoice Added Successfuly!");
            return response()->json(['success' => true], 201);
        }catch(Exception $e){
            Session::flash("error",$e->getMessage());
            return redirect("/employee-types/add");
        }
    }

    function search_invoice(Request $req){
        $type = $req->type;

        if($type == "bill_no"){
            $get = saleInvoice::with([
                'sale_invoice_lists.item',
                'sale_invoice_lists.godown',
                'godown'
            ])
                ->where('bill_no', $req->value)
                ->first();
            return $get;
            //$itemInvoiceId = $get->sale_invoice_lists->pluck('item_invoice_id')->first();
            //$comment = invoice_comment::where('invoice_id', $itemInvoiceId)->get();
            /*$comment = invoice_comment::join('users', 'users.id', '=', 'invoice_comment.added_by')
                ->where('invoice_comment.invoice_id', $itemInvoiceId)
                ->select(
                    'invoice_comment.*',
                    'users.name as user_name'
                )
                ->get();*/
        }elseif ($type == "vr_no"){
            $get = ItemInvoice::with([
                'item_invoice_lists.item',
                'item_invoice_lists.godown',
                'godown'
            ])
                ->where('vr_no', $req->value)
                ->first();
            //$get = ItemInvoice::with("item_invoice_lists.item")->with("godown")->where("",$req->value)->get()->first();
            $itemInvoiceId = $get->item_invoice_lists->pluck('item_invoice_id')->first();
            $comment = invoice_comment::where('invoice_id', $itemInvoiceId)->get();
        }elseif ($type == "bilty_no"){
            $get = ItemInvoice::with([
                'item_invoice_lists.item',
                'item_invoice_lists.godown',
                'godown'
            ])
                ->where('bilty_no', $req->value)
                ->first();
            //$get = ItemInvoice::with("item_invoice_lists.item")->with("godown")->where("bilty_no",$req->value)->get()->first();
            $itemInvoiceId = $get->item_invoice_lists->pluck('item_invoice_id')->first();
            $comment = invoice_comment::where('invoice_id', $itemInvoiceId)->get();
        }elseif ($type == "party_inv_no"){
            $get = ItemInvoice::with([
                'item_invoice_lists.item',
                'item_invoice_lists.godown',
                'godown'
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
    public function search_party_id(Request $req)
    {
        // Fetch party details with relations
        $party = Party::with("party_mobiles")->with("party_less")->with("area")->with("area.city")->find($req->value);

        if (!$party) {
            return response()->json([
                'error' => 'Party not found'
            ], 404);
        }

        // Fetch invoices only for the entered party
        $amounts = SaleInvoice::where('party_id', $req->value)
            ->selectRaw('SUM(net_amount) AS net_amount, SUM(paid_amount) AS paid_amount')
            ->groupBy('party_id')
            ->get();
        //print_r($amounts);

        return response()->json([
            'party'   => $party,
            'amounts' => $amounts
        ]);
    }

}
