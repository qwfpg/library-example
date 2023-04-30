<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ModelController;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Repositories\BookRepositoryInterface;
use App\Services\CoverImageServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BookController extends ModelController
{
    public function __construct(
        BookRepositoryInterface                     $bookRepository,
        private readonly CoverImageServiceInterface $coverImageService
    )
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
        $validated = $request->validated();
        $validated['cover'] = $this->coverImageService->handleImageStore($request, 'cover', 'covers');
        $book = $this->repository->create($validated);

        return new BookResource($book);
    }

    public function update(UpdateBookRequest $request, Book $book): BookResource
    {
        $validated = $request->validated();
        $validated['cover'] = $this->coverImageService->handleImageUpdate($request, $book->cover, 'cover', 'covers');
        $this->repository->update($book, $validated);

        return new BookResource($book);
    }

    public function destroy(Book $book): JsonResponse
    {
        $this->coverImageService->handleImageDelete($book->cover);
        $this->repository->delete($book);

        return response()->json(null, 204);
    }
}
