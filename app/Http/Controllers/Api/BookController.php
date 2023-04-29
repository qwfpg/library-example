<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ModelController;
use App\Http\Requests\StoreBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Repositories\BookRepositoryInterface;
use App\Services\ImageServiceInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BookController extends ModelController
{
    public function __construct(BookRepositoryInterface $bookRepository, private readonly ImageServiceInterface $imageService)
    {
        parent::__construct($bookRepository);
    }

    public function index(): AnonymousResourceCollection
    {
        $books = $this->repository->paginate(10);
        return BookResource::collection($books);
    }

    public function show(Book $book): BookResource
    {
        return new BookResource($book);
    }

    public function store(StoreBookRequest $request): BookResource
    {
        $book = $this->repository->create($request->validated());
        return new BookResource($book);
    }

    public function update(StoreBookRequest $request, Book $book): void
    {
        if ($request->hasFile('cover')) {
            if ($book->cover) {
                $this->imageService->deleteImage($book->cover);
            }
            $image = $request->file('cover');
            $path = $this->imageService->saveImage($image, 'covers');
            $validated['cover'] = $path;
        }

    }
}
