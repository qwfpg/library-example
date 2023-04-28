<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\BooksImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportBooksController extends Controller
{
    public function import(Request $request)
    {
        $file = $request->file('import_file');

        if ($file) {
            try {
                Excel::import(new BooksImport, $file);
            }
            catch (\Exception $e) {
                return redirect()->back()->with(['error' => 'The file could not be processed.']);
            }

            return redirect()->back()->with('success', 'The books have been successfully imported.');
        }

        return redirect()->back()->with(['error' => 'Failed to upload file.']);
    }
}
