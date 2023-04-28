<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use \Illuminate\Contracts\Foundation\Application as ApplicationContract;

class PageController extends Controller
{
    public function getHomePage(): View|Application|Factory|ApplicationContract
    {
        $books = Book::with('category')->latest()->paginate(10);
        
        return view('books-index', compact('books'));
    }

    public function getBookShowPage(string $slug): View|Application|Factory|ApplicationContract
    {
        $book = Book::with('comments.user')->where('slug', $slug)->first();
        if (!$book) {
            abort(404);
        }
        return view('book', compact('book'));
    }


    public function getCategoryIndexPage(): View|Application|Factory|ApplicationContract
    {
        $categories = Category::paginate(10);
        return view('categories-index', compact('categories'));
    }

    public function getBooksIndexPageByCategorySlug(string $slug): View|Application|Factory|ApplicationContract
    {
        $category = Category::where('slug', $slug)->first();
        $books = $category->books()->with('category')->latest()->paginate(10);
        return view('books-index', compact('category', 'books'));
    }
}
