<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Session;

class SettingController extends Controller
{
    //
    function retail_sale_rate(){
        $settings = Setting::first();
        return view("admin.retail-sale-rate.retail-sale-rate",["get"=> $settings]);
    }

    function update_retail_sale_rate(Request $req){

        $i = Setting::first();
        $i->retail_sale_rate = $req->retail_sale_rate;
        $i->retail_sale_rate_rs = $req->retail_sale_rate_rs;
        $i->save();

        Session::flash("success","Retail Sale Rate Updated Successfuly!");
        return redirect()->route("retail-sale-rate");
    }

    function barcode(){
        $settings = Setting::first();
        return view("admin.barcode-setting.barcode-setting",["get"=> $settings]);
    }

    function update_barcode(Request $req,$size){

        $i = Setting::first();
        $i->barcode = $size;
        $i->save();

        Session::flash("success","Barcode Updated Successfuly!");
        return redirect()->route("barcode-setting");
    }

}
