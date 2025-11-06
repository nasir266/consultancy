<?php

namespace App\Http\Controllers;

use App\Models\bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class bankController extends Controller
{
    public function index(){
        $id = bank::latest('id')->value('id');
        return view('admin.bank.bank')->with('id', $id);
    }

    public function create(Request $request){
        return print_r($request->all());


        /*$data= [
            'name' => $request->b_name,
            'account_title' => $request->account_title,
            'account_no' => $request->account_no,
            'balance' => $request->balance,
            'remarks' => $request->remarks,
            'date' => $request->date,
            'status' => $request->status,
        ];
        $create= DB::table('bank')->insert($data);


        if($create) {
            Session::flash('success', 'bank Added Successfuly!');
            return response()->json(['result' => 'success'], 201);
        }*/
    }
    function search_bank_id(Request $req){
        if($req->type == "id"){
            $get = bank::find($req->value);
        }else{
            $get = bank::where("item_code",$req->value)->first();
        }
        return response()->json($get);
    }
}
