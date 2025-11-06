<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ContactsImport;
use Maatwebsite\Excel\Facades\Excel;

class ContactsImportController extends Controller
{
    public function showForm()
    {
        return view('admin.sync-contact.index');
    }

    public function import(Request $request)
    {
        $request->validate([
            'contacts_file' => 'required|file|mimes:csv,txt,xlsx,xls|max:20480',
        ]);

        $import = new ContactsImport();
        Excel::import($import, $request->file('contacts_file'));

        return back()->with([
            'success' => "Imported {$import->created} contact(s). Skipped {$import->skipped}.",
            'report'  => [
                'created' => $import->created,
                'skipped' => $import->skipped,
                'errors'  => $import->errors, // reasons per skipped row
            ],
        ]);
    }
}
