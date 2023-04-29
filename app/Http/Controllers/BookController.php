<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Models\Book;
use App\Repositories\BookRepositoryInterface;
use App\Repositories\CategoryRepositoryInterface;
use App\Services\ImageServiceInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;

class BookController extends ModelController
{

    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly ImageServiceInterface       $imageService,
        BookRepositoryInterface                      $repository,
    )
    {
        parent::__construct($repository);
    }


    public function index(): View
    {
        $books = $this->repository->paginate(10);
        return view('books.index', compact('books'));
    }

    public function create(): View|Application|Factory|ApplicationContract
    {
        $categories = $this->categoryRepository->all();

        return view('books.edit', [
            'categories' => $categories,
            'title' => 'Create new book',
            'action' => 'books.store',
        ]);
    }

    public function store(StoreBookRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('cover')) {
            $image = $request->file('cover');
            $path = $this->imageService->saveImage($image, 'covers');
            $validated['cover'] = $path;
        }
        $this->repository->create($validated);

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    public function edit(Book $book): View
    {
        $categories = $this->categoryRepository->all();

        return view('books.edit', [
                'categories' => $categories,
                'book' => $book,
                'title' => 'Edit book',
                'action' => 'books.update',
                'method' => 'PATCH'
            ]
        );
    }

    public function update(StoreBookRequest $request, Book $book): RedirectResponse
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
        $this->repository->update($book, $validated);

        return redirect()
            ->route('books.index')
            ->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book): RedirectResponse
    {
        if ($book->cover) {
            $this->imageService->deleteImage($book->cover);
        }
        $this->repository->delete($book);

        return redirect()
            ->route('books.index')
            ->with('success', 'Book deleted successfully.');
    }
}
