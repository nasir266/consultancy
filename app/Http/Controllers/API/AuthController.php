<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\AppUser;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    //
    protected function success($data, string $message = null, int $code = 200)
	{
		return response()->json([
			'status' => 'Success',
			'data' => $data
		], $code);
	}

    public function login(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required|string|email|',
            'password' => 'required|string|min:6'
        ]);

        if (!Auth::attempt($attr)) {
            return $this->error('Credentials not match', 401);
        }

        return $this->success([
            'token' => auth()->user()->createToken('API Token')->plainTextToken
        ]);
    }


    function register_user(Request $req){

        $req->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $imageName = "";
        if($req->image  != ""){
            $imageName = time().'.'.$req->image->extension();              
            $req->image->move(public_path('images'), $imageName);
        }


        $userCount = AppUser::where('email', $req->email);
        if ($userCount->count()) {
            return response()->json(array("result"=>"already")); 
        } 

        $userCount = AppUser::where('phone', $req->phone);
        if ($userCount->count()) {
            return response()->json(array("result"=>"already")); 
        } 


        $fetch = new AppUser;
        $fetch->name = $req->name;
        $fetch->email = $req->email;
        $fetch->phone = $req->phone;
        $fetch->user_type = $req->user_type;
        $fetch->password = Hash::make($req->password);
        $fetch->image = $imageName;
        $fetch->save();

        if($fetch){
           return response()->json(array("result"=>"success","id"=>$fetch->id)); 
        }

    }

    function login_user(Request $req){

        $user = AppUser::where('phone', '=', $req->phone)->where('user_type', '=', $req->user_type)->first();
        $check = Hash::check($req->password, $user["password"]);

        if($user['activate_status'] == "false"){
            return response()->json(array("result"=>"activate")); 
        }
        if ($check) {
            return response()->json(array("result"=>"success","id"=>$user['id'])); 
        }else{
            return response()->json(array("result"=>"fail")); 
        }

    }











}
