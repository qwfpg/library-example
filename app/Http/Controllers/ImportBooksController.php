<?php

namespace App\Http\Controllers;

use App\Repositories\BookRepositoryInterface;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Imports\BooksImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportBooksController extends Controller
{
    public function import(
        Request                     $request,
        BookRepositoryInterface     $bookRepository,
        CategoryRepositoryInterface $categoryRepository
    ): RedirectResponse
    {
        $file = $request->file('import_file');

        if ($file) {
            try {
                $import = new BooksImport($bookRepository, $categoryRepository);
                Excel::queueImport($import, $file);
            } catch (\Exception $e) {
                return redirect()->back()->with(['error' => 'The file could not be processed.']);
            }
            return redirect()->back()->with('success', 'The books have been successfully imported.');
        }

        return redirect()->back()->with(['error' => 'Failed to upload file.']);
    }
}
