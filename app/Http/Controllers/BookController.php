<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Models\Book;
use App\Models\Category;
use App\Services\ImageServiceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    private ImageServiceInterface $imageService;

    public function __construct(ImageServiceInterface $imageService)
    {
        $this->imageService = $imageService;
    }

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
            'title' => 'Create new book',
            'action' => 'books.store',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $book = new Book($validated);

        if ($request->hasFile('cover')) {
            $image = $request->file('cover');
            $path = $this->imageService->saveImage($image, 'covers');
            $book->cover = $path;
        }
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
                'title' => 'Edit book',
                'action' => 'books.update',
                'method' => 'PATCH'
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreBookRequest $request, Book $book)
    {
        $validated = $request->validated();

        if ($request->hasFile('cover')) {
            if ($book->cover) {
                $this->imageService->deleteImage($book->cover);
            }
            $image = $request->file('cover');
            $path = $this->imageService->saveImage($image, 'covers');
            $validated['cover'] = $path;
        }

        $book->fill($validated);
//        $book->slug = Str::slug($validated['title']);

        $book->save();

        return redirect()
            ->route('books.index')
            ->with('success', 'Книга успешно обновлена.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Книга успешно удалена.');
    }
}
