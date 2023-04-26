<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $books = Book::paginate(10);

        return $this->getView('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return $this->getView('books.edit', [
            'categories' => $categories,
            'title' => 'Create new book'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request): RedirectResponse
    {
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $coverName = time() . '-' . $cover->getClientOriginalName();
            $cover->storeAs('public/covers', $coverName);
        } else {
            $coverName = null;
        }

        $book = new Book([
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'author' => $request->input('author'),
            'description' => $request->input('description'),
            'rating' => $request->input('rating'),
            'cover' => $coverName,
            'category_id' => $request->input('category_id'),
        ]);

        $book->save();

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book): View
    {
        $categories = Category::all();

        return $this->getView('books.edit', [
                'categories' => $categories,
                'book' => $book,
                'title' => 'Edit book'
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Книга успешно удалена.');
    }
}
