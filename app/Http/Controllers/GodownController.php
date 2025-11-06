<?php

namespace App\Http\Controllers;

use App\Models\Godown;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GodownController extends Controller
{
    public function index(){
        $godowns = Godown::all();
        if($godowns->isEmpty()){
            $last_id = 1;
        }else{
            $last_id = Godown::orderBy('id', 'desc')->first();
            $last_id = $last_id->id + 1;
        }

        return view('admin.goddown.goddown')->with(['godowns'=>$godowns,'last_id'=>$last_id] );
    }

    public function make_default(Request $request)
    {
        $def_value = $request->def_value;
        $item_value = $request->item_value;

        $sale_value = $request->sale_value;
        $sale_r_value = $request->sale_r_value;
        $r_sale_value = $request->r_sale_value;
        $r_sale_r_value = $request->r_sale_r_value;
        $p_invoice_value = $request->p_invoice_value;
        $p_invoice_r_value = $request->p_invoice_r_value;

        $update_id = $request->update_id;

        if($def_value == '' && $sale_value == '' && $item_value == '' && $sale_r_value == '' && $r_sale_value == '' && $r_sale_r_value == '' && $p_invoice_value == '' && $p_invoice_r_value == ''){
            echo 'error';
        }else{
            $value = '';
            if($def_value != ''){
                $value .= $def_value;
            }

            if($item_value != ''){
                if($value != ''){
                    $value .= ','.$item_value;
                }else{
                    $value .= $item_value;
                }

            }
            if($sale_value != ''){
                if($value != ''){
                    $value .= ','.$sale_value;
                }else{
                    $value .= $sale_value;
                }
            }
            if($sale_r_value != ''){
                if($value != ''){
                    $value .= ','.$sale_r_value;
                }else{
                    $value .= $sale_r_value;
                }
            }
            if($r_sale_value != ''){
                if($value != ''){
                    $value .= ','.$r_sale_value;
                }else{
                    $value .= $r_sale_value;
                }
            }
            if($r_sale_r_value != ''){
                if($value != ''){
                    $value .= ','.$r_sale_r_value;
                }else{
                    $value .= $r_sale_r_value;
                }
            }
            if($p_invoice_value != ''){
                if($value != ''){
                    $value .= ','.$p_invoice_value;
                }else{
                    $value .= $p_invoice_value;
                }
            }
            if($p_invoice_r_value != ''){
                if($value != ''){
                    $value .= ','.$p_invoice_r_value;
                }else{
                    $value .= $p_invoice_r_value;
                }
            }

            $row = DB::table('godowns')->where('id', '=', $update_id)->update(['default_status' => $value]);
            if($row){
                echo 'success';
            }else{
                echo 'error';
            }
        }
    }

    public function addGoddown(Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        echo $request->id;
        $row = DB::table('godowns')->where('id', '=', $request->id);
        if($row->count() > 0){

            $update = DB::table('godowns')->where('id', '=', $request->id)
                ->update(['name' => $request->name]);
           // dd($update);
            if($update){
                return redirect()->route('goddown')->with('success','Godown update successfully');
            }else{
                return redirect()->route('goddown')->with('error','Something went wrong');
            }
        }else{
            $row = DB::table('godowns')->where('id', '=', $request->name);
            if($row->count() > 0){
                return redirect()->route('goddown')->with('error','Name already exist');
            }else{
                $godown = new Godown();
                $godown->name = $request->name;
                $save = $godown->save();
                if($save){
                    return redirect()->route('goddown')->with('success','Godown added successfully');
                }else{
                    return redirect()->route('goddown')->with('error','Something went wrong');
                }
            }
        }
        /**/


    }

    public function delete_godown($id){
        $data = Godown::find($id);
        $data->delete();
        return redirect()->route('goddown')->with('delete','Godown deleted successfully');

    }

    public function updateGodown(Request $request){
        $godown_id = $request->id;
        $data = DB::table("godowns")->where("id","=",$godown_id)->first();
        //$data = Godown::find(3);
        echo json_encode($data);

    }
    public function fetchDefaultValue(Request $request){
        $godown_id = $request->id;
        //echo $godown_id;
        $data = DB::table("godowns")->where("id","=",$godown_id)->first();
        //print_r($data->default_status);
        $array_data = [];
        foreach (explode(',', $data->default_status) as $key => $value) {
            $array_data[$key] = $value;
        }
        //print_r($array_data);
        //$data = Godown::find(3);
        echo json_encode($array_data);

    }
    public function updateGodownForm(Request $request){
        $g_name = $request->g_name;
        $g_id = $request->g_id;
        $row =DB::table('godowns')
            ->where('id', $g_id)
            ->update(['name' => $g_name]);
        //print_r($row);
        if($row){
            echo 'success';
        }else{
            echo 'error';
        }
    }
}
