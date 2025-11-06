<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppUser;
use App\Models\AllArea;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function login()
    {
        return view('login');
    }

    function loginSubmit(Request $request)
    {
        $loginData = $request->validate([
           'email' => 'required|string|email|max:255',
           'password' => 'required',
        ]);

        if(Auth::attempt($loginData)){
            return redirect()->route('home');
        }else{
            return redirect()->route('loginForm')->with('error', 'Wrong Email or Password');
        }
        //dd($request->all());
    }
    function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('loginForm');
    }
    function index(){
        $fetch = AppUser::where("user_type","user")->orderBy("id","DESC")->get();
        return view("admin.users.users",["users"=>$fetch]);
    }

    function add(Request $req){
        $fetch = new AppUser;
        $fetch->name = $req->name;
        $fetch->email = $req->email;
        $fetch->phone = $req->phone;
        $fetch->user_type = "user";
        $fetch->password = Hash::make($req->password);
        $fetch->save();
        Session::flash("success","User Added Successfuly!");
        return redirect("/users");
    }

    function edit($id){
        $fetch = AppUser::find($id);
        return view("admin.users.edit-user",["users"=>$fetch]);
    }

    function view($id){
        $fetch = AppUser::find($id);
        return view("admin.users.view-user",["users"=>$fetch]);
    }

    function editpost($id,Request $req){
        $fetch = AppUser::find($id);
        $fetch->name = $req->name;
        $fetch->email = $req->email;
        $fetch->phone = $req->phone;
        // $fetch->activate_status = $req->activate_status;
        // $fetch->premium_status = $req->premium_status;
        $fetch->save();
        Session::flash("success","Updated Successfuly!");
        return redirect("/users/edit/$id");
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
