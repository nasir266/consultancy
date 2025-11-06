<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\City;
use App\Models\Party;
use App\Models\Item;
use App\Models\ItemInvoice;
use App\Models\DefineItem;
use App\Models\DefineSize;
use App\Models\PartyMobile;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{


    public function getItemDetails(Request $request)
    {
        $item = Item::with("define_item")->with("define_size")->findOrFail($request->id);
        return response()->json([
            'name' => $item->define_item->name,
            'size' => $item->define_size->name,
            'code' => $item->item_code,
            'sale_rate' => $item->sale_rate,
            'barcode' => $item->barcode,
        ]);
    }


    public function check_party_mobile(Request $request)
    {
            $request->validate([
                'mobile' => 'required|numeric',
                'exclude_id' => 'nullable|integer',
            ]);

            $mobile = $request->input('mobile');
            $excludeId = $request->input('exclude_id');

            // Query to find the ID in the Party table
            $partyRecord = Party::where('mobile', $mobile)
                ->when($excludeId, function ($query) use ($excludeId) {
                    return $query->where('id', '<>', $excludeId);
                })
                ->first();

            // Query to find the ID in the PartyMobile table
            $partyMobileRecord = PartyMobile::where('mobile', $mobile)
                ->when($excludeId, function ($query) use ($excludeId) {
                    return $query->where('party_id', '<>', $excludeId); // Assuming 'party_id' is the foreign key in PartyMobile
                })
                ->first();

            // Check if any record exists and retrieve the IDs
            $exists = false;
            $id = null;

            if ($partyRecord) {
                $exists = true;
                $id = $partyRecord->id;
            } elseif ($partyMobileRecord) {
                $exists = true;
                $id = $partyMobileRecord->party_id; // Assuming 'party_id' links to the Party table
            }

            return response()->json([
                'exists' => $exists,
                'id' => $id, // ID of the record where the mobile exists
            ]);
    }

    function get_item_codes(Request $req,$id){
        $get = Item::where("party_id",$id)->pluck("item_code");
        return response()->json($get);
    }

    public function get_areas($city_id)
    {
        $areas = Area::where('city_id', $city_id)->get(['id', 'name']);
        return response()->json($areas);
    }


    function fetch_cities(Request $req){
        $get = City::get();
        return response()->json($get);
    }

    function search_party_id(Request $req){
        $get = Party::with("party_mobiles")->with("party_less")->with("area")->with("area.city")->find($req->value);
        return response()->json($get);
    }

    function search_item_id(Request $req){
        if($req->type == "id"){
            $get = Item::find($req->value);
        }else{
            $get = Item::where("item_code",$req->value)->first();
        }
        return response()->json($get);
    }
    function search_item_id_party(Request $req){

        $get = Item::where("item_code",$req->item_code)->where('party_id', $req->party_id)->first();
        //return print_r($get);
        return response()->json($get);
    }

    function search_invoice(Request $req){
        $get = ItemInvoice::with("item_invoice_lists.item")->with("godown")->where("bill_no",$req->value)->get()->first();
        return response()->json($get);
    }

    function insert_city(Request $request){

        try{
            $count = City::where("name",$request->name)->count();
            if($count > 0){
                return response()->json(['result' => "already"], 201);
            }
            $record = new City;
            $record->name = $request->name;
            $record->save();

            return response()->json(['result' => "success",'id'=>$record->id], 201);

        }catch(Exception $e){
            Session::flash("error",$e->getMessage());
            return redirect("/employee-types/add");
        }
    }

    function insert_define_item(Request $request){
        try{
            $count = DefineItem::where("name",$request->name)->count();
            if($count > 0){
                return response()->json(['result' => "already"], 201);
            }
            $record = new DefineItem;
            $record->name = $request->name;
            $record->save();

            return response()->json(['result' => "success",'id'=>$record->id], 201);

        }catch(Exception $e){
            Session::flash("error",$e->getMessage());
            return redirect("/employee-types/add");
        }
    }

    function insert_define_size(Request $request){
        try{
            $count = DefineSize::where("name",$request->name)->count();
            if($count > 0){
                return response()->json(['result' => "already"], 201);
            }
            $record = new DefineSize;
            $record->name = $request->name;
            $record->save();

            return response()->json(['result' => "success",'id'=>$record->id], 201);

        }catch(Exception $e){
            Session::flash("error",$e->getMessage());
            return redirect("/employee-types/add");
        }
    }

    function insert_area(Request $request){

        try{
            $record = new Area;
            $record->city_id = $request->city;
            $record->name = $request->name;
            $record->save();
            return response()->json(['success' => true,'id'=>$record->id], 201);
        }catch(Exception $e){
            Session::flash("error",$e->getMessage());
            return redirect("/employee-types/add");
        }
    }




}
