<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Repositories\BookRepositoryInterface;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use \Illuminate\Contracts\Foundation\Application as ApplicationContract;

class PageController extends Controller
{
    public function __construct(
        private readonly BookRepositoryInterface     $bookRepository,
        private readonly CategoryRepositoryInterface $categoryRepository
    )
    {
    }

    public function getHomePage(): View|Application|Factory|ApplicationContract
    {
        $books = $this->bookRepository->paginate(10, ['category']);

        return view('books-index', compact('books'));
    }

    public function getBookShowPage(string $slug): View|Application|Factory|ApplicationContract
    {
        $book = $this->bookRepository->findBySlug($slug);

        if (!$book) {
            abort(404);
        }
        return view('book', compact('book'));
    }

    public function getCategoryIndexPage(): View|Application|Factory|ApplicationContract
    {
        $categories = $this->categoryRepository->paginate(10);

        return view('categories-index', compact('categories'));
    }

    public function getBooksIndexPageByCategorySlug(string $slug): View|Application|Factory|ApplicationContract
    {
        $books = $this->bookRepository->findByCategorySlug($slug, 10);

        return view('books-index', compact('books'));
    }
}
