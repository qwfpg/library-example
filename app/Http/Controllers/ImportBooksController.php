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
            Excel::import(new BooksImport, $file);

            return redirect()->back()->with('success', 'Книги успешно импортированы.');
        }

        return redirect()->back()->withErrors(['import_file' => 'Не удалось загрузить файл.']);
    }
}
