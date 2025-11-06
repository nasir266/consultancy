<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Party;
use App\Models\DefineItem;
use App\Models\DefineSize;
use App\Models\Godown;
use App\Models\ItemInvoice;
use App\Models\Setting;
use Illuminate\Support\Str;
use Session;
use function PHPUnit\Framework\isEmpty;

class ItemController extends Controller
{
    //
    function index(){
        $id = Item::latest('id')->value('id');
        $parties = Party::all();
        $define_items = DefineItem::all();
        $define_sizes = DefineSize::all();
        $goddown = Godown::all();
        $bill_no = ItemInvoice::latest('id')->value('bill_no') + 1 ?? 1;
        $vr_no = ItemInvoice::where("date", date("Y-m-d"))->latest('id')->value('vr_no') + 1 ?? 1;
        $setting = Setting::first();
        /*if(isEmpty($setting)){
            $setting = [
                'retail_sale_rate  ' => '0',
                'retail_sale_rate_rs  ' => '0'

            ];
            $setting = (object)$setting;
        }*/
        $items = Item::orderBy("id","DESC")->get();

        $search_barcodes = Item::pluck("barcode");
        $search_pic = Item::pluck("item_code");
        $search_purchase_rate = Item::pluck("purchase_rate");


        $search_define_items = DefineItem::whereIn("id", $items->pluck("define_item_id"))->get();
        $search_define_sizes = DefineSize::whereIn("id", $items->pluck("define_size_id"))->get();

        $banks = ItemInvoice::pluck('bank')
        ->merge(ItemInvoice::pluck('bt_to'))
        ->unique()
        ->values()
        ->toArray();


        return view("admin.item.item",["id" => $id,"parties" => $parties,"define_items" => $define_items,"define_sizes" => $define_sizes,"goddown" => $goddown,"bill_no" => $bill_no, "vr_no" => $vr_no, "setting" => $setting,"items" => $items,"search_barcodes" =>$search_barcodes, "search_pic" => $search_pic, "search_purchase_rate" => $search_purchase_rate, "search_define_items" => $search_define_items ,"search_define_sizes" => $search_define_sizes, "banks" => $banks]);
    }

    function add(Request $request){

        try{
            //return print_r($request->all());

            /*$check = Item::where("item_code",$request->item_code)->where("id","!=",$request->id)->where("item_code","!=",'')->count();
            if($check > 0){
                return response()->json(['result' => 'item_code_exist'], 201);
            }*/

            $check = Item::where("description", $request->description)
            ->where("id", "!=", $request->id)
            ->get();

            if($check->count() > 0){
                return response()->json(['result' => 'description_exist',"id" => $check->first()->id], 201);
            }

            $imageName = null;
            if ($request->hasFile('image')) {
                $imageExtension = $request->file('image')->getClientOriginalExtension();
                $imageName = Str::random(40) . '.' . $imageExtension; // Generate a random file name
                $imagePath = $request->file('image')->storeAs('uploads/images', $imageName, 'public');
            }

            $data = [
                'date' => $request->date,
                'item_code' => $request->item_code,
                'barcode' => $request->barcode,
                'description' => $request->description,
                'purchase_rate' => $request->purchase_rate,
                'sale_rate' => $request->sale_rate,
                'party_discount' => $request->party_disc,
                'margin_field' => $request->margin_field,
                'party_less' => $request->party_less,
                'customer_less' => $request->customer_less,
                'wholesale_profit' => $request->profit,
                'packet_qty' => $request->packet_qty,
                'pieces_in_packet' => $request->pieces_in_packet,
                'total_pieces' => $request->total_pieces,
                'status' => $request->status ?? 'true',
                'retail_sale_rate_p' => $request->retail_sale_rate_p,
                'retail_sale_rate' => $request->retail_sale_rate,
                'retail_less' => $request->retail_less,
                'retail_discount' => $request->retail_discount,
                'retail_profit' => $request->retail_profit,
                'min_level' => $request->min_level,
                'max_level' => $request->max_level,
                'w_sale_man_commension' => $request->w_sale_man_commension,
                'r_sale_man_commension' => $request->r_sale_man_commension,
                'define_item_id' => $request->define_item_id,
                'define_size_id' => $request->define_size_id,
                'party_id' => $request->party_id,
                'image' => $imageName,
            ];

            $record = Item::updateOrCreate(
                ['id' => $request->id],
                $data
            );

            Session::flash("success","Party Added Successfuly!");
            return response()->json(['result' => 'success'], 201);
        }catch(Exception $e){
            Session::flash("error",$e->getMessage());
            return redirect("/employee-types/add");
        }
    }

    public function search(Request $request)
    {
        $query = Item::query();

        $searchTerm = $request->search_item; // Get the search input

        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('item_code', 'like', "%{$searchTerm}%")
                    ->orWhere('barcode', 'like', "%{$searchTerm}%")
                    ->orWhere('image', 'like', "%{$searchTerm}%")
                    ->orWhere('define_item_id', 'like', "%{$searchTerm}%")
                    ->orWhere('define_size_id', 'like', "%{$searchTerm}%")
                    ->orWhere('purchase_rate', 'like', "%{$searchTerm}%")
                    ->orWhere('sale_rate', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%")
                    ->orWhere('party_discount', 'like', "%{$searchTerm}%")
                    ->orWhere('party_less', 'like', "%{$searchTerm}%")
                    ->orWhere('customer_less', 'like', "%{$searchTerm}%")
                    ->orWhere('wholesale_profit', 'like', "%{$searchTerm}%")
                    ->orWhere('retail_sale_rate_p', 'like', "%{$searchTerm}%")
                    ->orWhere('retail_sale_rate', 'like', "%{$searchTerm}%")
                    ->orWhere('retail_less', 'like', "%{$searchTerm}%")
                    ->orWhere('retail_discount', 'like', "%{$searchTerm}%")
                    ->orWhere('retail_profit', 'like', "%{$searchTerm}%")
                    ->orWhere('w_sale_man_commension', 'like', "%{$searchTerm}%")
                    ->orWhere('r_sale_man_commension', 'like', "%{$searchTerm}%")
                    ->orWhere('min_level', 'like', "%{$searchTerm}%")
                    ->orWhere('max_level', 'like', "%{$searchTerm}%")
                    ->orWhere('status', 'like', "%{$searchTerm}%")
                    ->orWhereHas('party', function ($q) use ($searchTerm) {
                        $q->where('name', 'like', "%{$searchTerm}%");
                    });
            });
        }

        if ($request->search_barcode) {
            $query->where('barcode', $request->search_barcode);
        }
        if ($request->search_pic) {
            $query->where('item_code', $request->search_pic);
        }
        if (!empty($request->search_define_item)) {
            $query->where('define_item_id', $request->search_define_item);
        }
        if (!empty($request->search_define_size)) {
            $query->where('define_size_id', $request->search_define_size);
        }
        if (!empty($request->search_party)) {
            $query->where('party_id', $request->search_party);
        }
        if ($request->search_purchase_rate) {
            $query->where('purchase_rate', $request->search_purchase_rate);
        }

        $items = $query->with("define_item")->with("define_size")->with('party')->get(); // Load the party relationship



        $column = $request->search_column;
        $value = $request->search_value;

        // $query = ($value != "" && !$searchTerm) ? Item::where($column, $value)->get() : Item::all();

        $dropdown_data = [
            "define_item_id" => DefineItem::whereIn("id", $query->pluck("define_item_id"))->get(),
            "define_size_id" => DefineSize::whereIn("id", $query->pluck("define_size_id"))->get(),
            "party_id" => Party::whereIn("id", $query->pluck("party_id"))->get(),
            "barcode" => Item::selectRaw("CAST(barcode AS CHAR) as id, CAST(barcode AS CHAR) as name")
            ->whereIn("id", $query->pluck("id"))
            ->get(),
            "item_code" => Item::select("item_code")
            ->whereIn("id", $query->pluck("id"))
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->item_code,
                    'name' => $item->item_code,
                ];
            }),
            "purchase_rate" => Item::selectRaw("CAST(purchase_rate AS CHAR) as id, CAST(purchase_rate AS CHAR) as name")->whereIn("id", $query->pluck("id"))->get(),
        ];

        return response()->json([
            'items' => $items,
            'dropdown_data' => $dropdown_data
        ]);
    }

}
