<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Item;
use App\Models\ItemInvoice;
use App\Models\ItemInvoiceList;
use App\Models\Party;
use Illuminate\Http\Request;
use App\Models\define_item;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class IndexConroller extends Controller
{
    public function index(){
        $total_party = Party::count();
        $total_item = define_item::count();
        $total_invoice = ItemInvoice::count();
        $total_city = City::count();

        $months = [];
        $currentMonth = Carbon::now();

        for ($i = 0; $i < 12; $i++) {
            $months[] = $currentMonth->copy()->subMonths($i)->format('F');
        }
        $data = [];
        foreach ($months as $month) {
            //$data = Party::count()->where('MONTH(created_at)', '=', $month)->get();

            $data[] = Party::select(DB::raw("count(id) as total"))
                ->whereMonth('created_at', '=', $month)
                ->get();
        }


        //dd($data);

        return view('admin.index')->with(['total_party' => $total_party, 'total_item' => $total_item, 'total_invoice' => $total_invoice, 'total_city' => $total_city]);
    }

    //public function total_party()
}
