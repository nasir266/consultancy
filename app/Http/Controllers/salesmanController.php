<?php

namespace App\Http\Controllers;

use App\Models\salesman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class salesmanController extends Controller
{
    public function index()
    {
        $id = salesman::latest('id')->value('id');
        return view('admin.sales-man.sales-man')->with('id', $id);
    }
    public function create(Request $request){

        /*try{

            //return response()->json(['data' => $request->all()], 201);
        }catch(Exception $e){
            Session::flash("error",$e->getMessage());
            //return redirect("/employee-types/add");
        }*/
        $data= [
            'name' => $request->name,
            'phone' => $request->phone,
            'date' => $request->date,
            'address' => $request->address,
            'recovery' => $request->recovery,
            'sales' => $request->sales,
            'salary' => $request->salary,
            'status' => $request->status,
        ];
        $create= DB::table('salesman')->insert($data);


        if($create) {
            Session::flash('success', 'salesman Added Successfuly!');
            return response()->json(['result' => 'success'], 201);
        }
    }

    function search_salesman_id(Request $req){
        if($req->type == "id"){
            $get = salesman::find($req->value);
        }else{
            $get = salesman::where("item_code",$req->value)->first();
        }
        return response()->json($get);
    }
}
