<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\bank;

class BankController extends Controller
{
    public function index()
    {
        $lastBank = bank::latest('id')->first();
        $id = $lastBank ? $lastBank->id : 0;
        $banks = bank::all();
        return view('admin.bank.bank')->with(['id' => $id, 'banks' => $banks]);

    }

    public function create(Request $request)
    {
        // Validate input
        $request->validate([
            'b_name' => 'required|string|max:255',
            'account_title' => 'nullable|string|max:255',
            'account_no' => 'required|string|max:50',
            'balance' => 'nullable|numeric',
            'remarks' => 'nullable|string',
            'date' => 'required|date',
            'status' => 'required|in:on,off',
        ]);

        try {
            Bank::create([
                'name' => $request->b_name,
                'account_title' => $request->account_title,
                'account_no' => $request->account_no,
                'balance' => $request->balance,
                'remarks' => $request->remarks,
                'date' => $request->date,
                'status' => $request->status,
            ]);

            return response()->json(['success' => true, 'message' => 'Bank added successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
    function search_bank_id(Request $req){
        if($req->type == "id"){
            $get = bank::find($req->value);
        }else{
            $get = bank::where("item_code",$req->value)->first();
        }
        return response()->json($get);
    }
    public function search(Request $request)
    {
        $query = $request->get('query', '');

        $banks = Bank::where('name', 'like', "%{$query}%")
            ->orWhere('account_title', 'like', "%{$query}%")
            ->limit(10)
            ->get(['id', 'name', 'account_title']);

        return response()->json($banks);
    }
}
