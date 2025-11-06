<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Post;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;



class ApiController extends Controller
{
    //
    use ApiResponser;

    function register(Request $req,$id){

        try{

        $validator = Validator::make($req->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required',
            'city' => 'required',
            'country' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(),500);
        }


        $check = Customer::where("email",$req->email)->count();

        if($check > 0){
            return $this->successResponse(null,'already', 201);
        }

        $fetch = new Customer;
        $fetch->name = $req->name;
        $fetch->email = $req->email;
        $fetch->phone = $req->phone;
        $fetch->password = Hash::make($req->password);
        $fetch->city = $req->city;
        $fetch->country = $req->country;
        $fetch->save();


        if($fetch){
            return $this->successResponse(null,'success', 201);
        }

        }catch(Exception $e){
            return $this->errorResponse($e->getMessage(),500);
        }

    }



    function update_profile(Request $req,$id){

        try{

        $validator = Validator::make($req->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'country' => 'required',

        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(),500);
        }



        $fetch = Customer::find($id);
        $fetch->name = $req->name;
        $fetch->email = $req->email;
        $fetch->phone = $req->phone;
        $fetch->city = $req->city;
        $fetch->country = $req->country;
        $fetch->save();


        if($fetch){
            return $this->successResponse(null,'success', 201);
        }

        }catch(Exception $e){
            return $this->errorResponse($e->getMessage(),500);
        }

    }

    function login(Request $req){

        try {

            $user = Customer::where('email', '=', $req->email)->first();
            $check = Hash::check($req->password, $user["password"]);


            $validator = Validator::make($req->all(), [
                'email' => 'required',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(),500);
            }

            if ($check) {
                return $this->successResponse($user,'success', 201);
            }else{
                return $this->successResponse(null,'fail', 201);
            }

        }catch(Exception $e){
            return $this->errorResponse($e->getMessage(),500);
        }
    }


    function get_profile(Request $req,$id){

        try {

            $user = Customer::find($id)->toArray();

            if ($user) {
                return $this->successResponse($user,'success', 201);
            }else{
                return $this->successResponse(null,'fail', 201);
            }

        }catch(Exception $e){
            return $this->errorResponse($e->getMessage(),500);
        }
    }

    function get_posts(Request $req){

        try {

            $get = Post::orderBy("id","DESC")->get();

            foreach ($get as $key => $value) {
                # code...
                $get[$key]['file'] =   url("images/". $get[$key]['file']);
            }

            if ($get) {
                return $this->successResponse($get,'success', 201);
            }else{
                return $this->successResponse(null,'fail', 201);
            }

        }catch(Exception $e){
            return $this->errorResponse($e->getMessage(),500);
        }
    }


    function add_post(Request $req){

        try{

        $validator = Validator::make($req->all(), [
            'type' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(),500);
        }

        $imageName = "";
        if($req->file  != ""){
            $imageName = time().'.'.$req->file->extension();
            $req->file->move(public_path('images'), $imageName);
        }


        $fetch = new Post;
        $fetch->type = $req->type;
        $fetch->content = $req->content;
        $fetch->file = $imageName;
        $fetch->user_type = "user";
        $fetch->save();


        if($fetch){
            return $this->successResponse(null,'success', 201);
        }

        }catch(Exception $e){
            return $this->errorResponse($e->getMessage(),500);
        }

    }


}
