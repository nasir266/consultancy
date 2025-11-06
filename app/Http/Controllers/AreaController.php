<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use App\Models\AppUser;
use App\Models\Area;
use Illuminate\Support\Carbon;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AreaController extends Controller
{
    //
    function index(){
        //$fetch = Area::orderBy("id","DESC")->get();

        $areas = DB::table('areas')
            ->leftJoin('cities', 'areas.city_id', '=', 'cities.id')
            ->select('areas.id', 'areas.name', 'cities.name as city_name')
            ->get();


        $allCity = City::all();
        //return $projects->all();
        return view("admin.area.area",["areas"=>$areas])->with("allCity",$allCity);
    }

    public function deleteArea($id)
    {
        $row = Area::find($id);
        $delete = $row->delete();
        if($delete){
            return redirect(route("area"))->with('success','row has been deleted');
        }else{
            return redirect(route("area"))->with('error','row has been deleted');
        }
    }
    public function updateArea(Request $request){
        $id = $request->id;
        $row = DB::table('areas')->where('id', $id)->first();

        $city_id = $row->city_id;

        $cities = DB::table('cities')->get();
       $select = '';
        foreach($cities as $city){
            if($city->id == $city_id){
                $select .= '<option value="'.$city->id.'" selected>'.$city->name.'</option>';
            }else{
                $select .= '<option value="'.$city->id.'">'.$city->name.'</option>';
            }
        }

        $arr = [];
        $arr['select'] = $select;
        $arr['row'] = $row;

        echo json_encode($arr);

        //echo json_encode($row);
    }

    public function addAreaForm(Request $request)
    {

        $city_id = $request->city_list;
        $a_name = $request->area_name;

        $create = new Area();
        $create->name = $a_name;
        $create->city_id = $city_id;
        $row = $create->save();
        //print_r($data);

        if($row){
            echo 'success';
        }else{
            echo 'error';
        }

    }
    public function updateAreaForm(Request $request)
    {
        $a_id = $request->a_id;
        $city_id = $request->city_id;
        $a_name = $request->a_name;

        $data = DB::table('areas')->where('id', $a_id)->first();
        //print_r($data);
        $created_at = $data->created_at;
        $updated_at = Carbon::now();
        $row =DB::table('areas')
            ->where('id', $a_id)
            ->update(['city_id' => $city_id, 'name' => $a_name, 'created_at' => $created_at, 'updated_at' => $updated_at]);
        if($row){
            echo 'success';
        }else{
            echo 'error';
        }

    }

    function add(Request $req){

        $fetch = new Area;
        $fetch->coordinates = $req->coordinates;
        $fetch->map_layer = $req->layer;
        $fetch->details = $req->details;
        $fetch->name = $req->name;
        $fetch->area = $req->address;
        $fetch->marker_lat = $req->lat;
        $fetch->marker_lng = $req->lng;
        $fetch->complete_address = $req->name. " ". $req->address;
        $fetch->save();


        Session::flash("success","Area Added Successfuly!");
        return response()->json(array("result"=>"success"));

    }

    function edit($id){

        $fetch = Area::find($id);
        return view("admin.areas.edit-area",["areas"=>$fetch,"coordinates"=>json_decode($fetch['coordinates'],true),"map_layer"=>$fetch['map_layer']]);
    }

    function add_view(){
        return view("admin.areas.add-area");
    }

    function editpost($id,Request $req){
        $fetch =  Area::find($id);
        if($req->layer != "undefined"){
        $fetch->map_layer = $req->layer;
        }
        if($req->has("coordinates")){
            $fetch->coordinates = $req->coordinates;
        }
        $fetch->details = $req->details;
        $fetch->name = $req->name;
        $fetch->area = $req->address;
        $fetch->marker_lat = $req->lat;
        $fetch->marker_lng = $req->lng;
        $fetch->complete_address = $req->name. " ". $req->address;
        $fetch->save();


        Session::flash("success","Updated Successfuly!");
        return response()->json(array("result"=>"success"));
    }

    function delete($id){

        $find = AppUser::find($id);
        $find->delete();
        Session::flash("success","User Deleted Successfuly!");
        return redirect("/users");

    }


    function activate_status($id,Request $req){
        $fetch = AppUser::find($id);

        if($fetch->activate_status == "false"){
        $fetch->activate_status = "true";
        }else{
            $fetch->activate_status = "false";
        }
        $fetch->save();
        Session::flash("success","Communication Successful!");
        if($fetch->user_type == "supervisor"){
        return redirect("/supervisors");
        }else if($fetch->user_type == "driver"){
            return redirect("/drivers");
        }else{
            return redirect("/users");
        }
    }


    function premium_status($id,Request $req){
        $fetch = AppUser::find($id);

        if($fetch->premium_status == "false"){
        $fetch->premium_status = "true";
        }else{
            $fetch->premium_status = "false";
        }
        $fetch->save();
        Session::flash("success","Communication Successful!");
        if($fetch->user_type == "supervisor"){
        return redirect("/supervisors");
        }else if($fetch->user_type == "driver"){
            return redirect("/drivers");
        }else{
            return redirect("/users");
        }
    }




    function assign_view($id,Request $req){

        $areas = AllArea::all();
        $fetch = AppUser::find($id);
        return view("admin.users.assign-area",["id"=>$id,"areas"=>$areas,"selected_areas"=>json_decode($fetch['areas'],true)]);

    }

    function assign_area($id,Request $req){
        $app_user = AppUser::find($id);
        $app_user->areas = $req->areas;
        $app_user->save();

        Session::flash("success","Area Assigned Successfuly!");

        return redirect("/users");

    }
}
