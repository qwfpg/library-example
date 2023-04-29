<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ModelController;
use App\Http\Resources\BookResource;
use App\Repositories\BookRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BookController extends ModelController
{
    public function __construct(BookRepositoryInterface $bookRepository)
    {
        parent::__construct($bookRepository);
    }

    public function index(): AnonymousResourceCollection
    {
        $books = $this->repository->paginate(10);
        return BookResource::collection($books);
    }
}
