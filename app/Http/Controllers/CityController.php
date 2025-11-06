<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CityController extends Controller
{
    public function fetchCity(Request $request){
        $allCity = City::all();
        return view('admin.city.city', ['allCity' => $allCity]);
    }
    public function deleteCity($id){
        $data = City::find($id);
        $check = $data->delete();
        if($check){
            return redirect(route('city'))->with("success","City deleted successfully");
        }else{
            return redirect(route('city'))->with("error","Something went wrong");
        }
    }

    public function updateCity(Request $request){
        $c_id = $request->id;
        $data = DB::table('cities')->where('id', $c_id)->first();

        echo json_encode($data);
    }

    public function addCityForm(Request $request){
        $c_name = $request->c_name;
        $check = DB::table('cities')->where('name', $c_name)->first();
        if(!$check){
            $create = new City();
            $create->name = $c_name;
            $row = $create->save();
            if($row){
                echo 'success';
            }else{
                echo 'error';
            }
        }else{
            echo 'error';
        }


    }
    public function updateCityForm(Request $request){
        $c_name = $request->c_name;
        $c_id = $request->c_id;
        $data = DB::table('cities')->where('id', $c_id)->first();
        $created_at = $data->created_at;
        $updated_at = Carbon::now();
        $row =DB::table('cities')
            ->where('id', $c_id)
            ->update(['name' => $c_name, 'created_at' => $created_at, 'updated_at' => $updated_at]);
        //print_r($row);
        if($row){
            echo 'success';
        }else{
            echo 'error';
        }
    }

}
