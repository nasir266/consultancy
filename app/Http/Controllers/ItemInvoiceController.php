<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\ItemInvoice;
use App\Models\ItemInvoiceList;
use Illuminate\Support\Str;
use Session;

class ItemInvoiceController extends Controller
{
    //

    function add(Request $request){
        //return print_r($request->all());
        //die();

        try{
            $data = [
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
                'party_id' => $request->party_id2,
            ];

            $record = ItemInvoice::updateOrCreate(
                ['bill_no' => $request->bill_no],
                $data
            );
            //return print_r($data);

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

                        $i->save();
                    }
                }
            } else {
                ItemInvoiceList::where('item_invoice_id', $record->id)->delete();
            }


            Session::flash("success","Invoice Added Successfuly!");
            return response()->json(['success' => true], 201);
        }catch(Exception $e){
            Session::flash("error",$e->getMessage());
            return redirect("/employee-types/add");
        }
    }
}
