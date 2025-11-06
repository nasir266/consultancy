<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Party;
use App\Models\City;
use App\Models\PartyMobile;
use App\Models\PartyLess;
use Illuminate\Support\Str;
use App\Imports\PartyImport;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class PartyController extends Controller
{
    
    function index(){

        $id = Party::latest('id')->value('id');
        $search_names = Party::pluck("name");
        $cities = City::all();
        $search = Party::with("party_mobiles")->get();
        
        return view("admin.party.party",["id"=>$id,"search_names"=>$search_names,"cities"=>$cities,"search" => $search]);
    }
    

    public function import(Request $request)
    {
        $request->validate([
    'excel_file' => 'required|file|mimes:xlsx,xls,csv',
        ]);
    
        Excel::import(new PartyImport, $request->file('excel_file'));
    
        return back()->with('success', 'Parties imported successfully!');
    }


    function add(Request $request){

        try{
             // Initialize variables for file paths
            $imageName = null;
            $fileName = null;
            $whatsappFileName = null;

             // Handle image upload
            if ($request->hasFile('image')) {
                $imageExtension = $request->file('image')->getClientOriginalExtension();
                $imageName = Str::random(40) . '.' . $imageExtension; // Generate a random file name
                $imagePath = $request->file('image')->storeAs('uploads/images', $imageName, 'public');
            }

            // Handle file upload
            if ($request->hasFile('file')) {
                $fileExtension = $request->file('file')->getClientOriginalExtension();
                $fileName = Str::random(40) . '.' . $fileExtension; // Generate a random file name
                $filePath = $request->file('file')->storeAs('uploads/files', $fileName, 'public');
            }

            // Handle WhatsApp file upload
            if ($request->hasFile('whatsapp_file')) {
                $whatsappFileExtension = $request->file('whatsapp_file')->getClientOriginalExtension();
                $whatsappFileName = Str::random(40) . '.' . $whatsappFileExtension; // Generate a random file name
                $whatsappFilePath = $request->file('whatsapp_file')->storeAs('uploads/whatsapp_files', $whatsappFileName, 'public');
            }

            // Create the record in the database
            $data = [
                'date' => $request->date,
                'name' => $request->name,
                'type' => $request->type,
                'area_id' => $request->area,
                'address' => $request->address,
                'discount' => $request->discount,
                'remark' => $request->remark,
                'status' => $request->status ?? 'active',
                'bill_limit' => $request->bill_limit,
                'duration' => $request->duration,
                'care_of' => $request->care_of,
                'email' => $request->email,
                'whatsapp_greeting' => $request->whatsapp_greeting,
                'mobile' => $request->mobile,
                'label' => $request->label,
                'image' => $imageName, // Save image path
                'file' => $fileName,   // Save file path
                'whatsapp_file' => $whatsappFileName, // Save WhatsApp file path
            ];
            
            $record = Party::updateOrCreate(
                ['id' => $request->id], // Condition to find the record
                $data                     // Data to update or insert
            );

            // Update or create multiple records in party_mobiles table
            if ($record) {
                $mobiles = $request->mobile1; // Array of mobiles from frontend
                $labels = $request->label1;   // Array of labels from frontend
            
                if (is_array($mobiles) && is_array($labels)) {
                    // Fetch existing party_mobiles for the current party
                    $existingMobiles = PartyMobile::where('party_id', $record->id)->get();
                    // Track IDs to retain
                    $retainIds = [];
            
                    foreach ($mobiles as $index => $mobile) {
                        $label = $labels[$index] ?? null; // Get corresponding label
            
                        // Try to find an existing record by index or position
                        $existingRecord = $existingMobiles[$index] ?? null;
            
                        if ($existingRecord) {
                            // Update the existing record if mobile or label has changed
                            $existingRecord->update([
                                'mobile' => $mobile,
                                'label' => $label,
                                'party_id' => $record->id,
                            ]);
                            $retainIds[] = $existingRecord->id;
                        } else {
                            if($mobile != ""){
                                // Create a new record if no existing record at this index
                                $newRecord = PartyMobile::create([
                                    'mobile' => $mobile,
                                    'label' => $label,
                                    'party_id' => $record->id,
                                ]);
                                $retainIds[] = $newRecord->id;
                            }
                        }
                    }
            
                    // Delete records not in the retain list
                    PartyMobile::where('party_id', $record->id)
                        ->whereNotIn('id', $retainIds)
                        ->delete();


                    $fromValues = $request->from; // Array of 'from' values from frontend
                    $toValues = $request->to;     // Array of 'to' values from frontend
                    $lessValues = $request->less; // Array of 'less' values from frontend

                    if (is_array($fromValues) && is_array($toValues) && is_array($lessValues)) {
                        // Fetch existing party_less records for the current party
                        $existingLessRecords = PartyLess::where('party_id', $record->id)->get();

                        // Track IDs to retain
                        $retainIds = [];

                        foreach ($fromValues as $index => $from) {
                            $to = $toValues[$index] ?? null;   // Get corresponding 'to' value
                            $less = $lessValues[$index] ?? null; // Get corresponding 'less' value

                            // Try to find an existing record by index or position
                            $existingRecord = $existingLessRecords[$index] ?? null;

                            if ($existingRecord) {
                                // Update the existing record if 'from', 'to', or 'less' has changed
                                $existingRecord->update([
                                    'from' => $from,
                                    'to' => $to,
                                    'less' => $less,
                                    'party_id' => $record->id,
                                ]);
                                $retainIds[] = $existingRecord->id;
                            } else {
                                if($from != ""){
                                    // Create a new record if no existing record at this index
                                    $newRecord = PartyLess::create([
                                        'from' => $from,
                                        'to' => $to,
                                        'less' => $less,
                                        'party_id' => $record->id,
                                    ]);
                                    $retainIds[] = $newRecord->id;
                                }
                            }
                        }

                        // Delete records not in the retain list
                        PartyLess::where('party_id', $record->id)
                            ->whereNotIn('id', $retainIds)
                            ->delete();
                    }

                }
            }
            
            Session::flash("success","Party Added Successfuly!");
            return response()->json(['success' => true], 201);

        }catch(Exception $e){
            Session::flash("error",$e->getMessage());
            return redirect("/employee-types/add");
        }
    }


}
