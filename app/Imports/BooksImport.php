<?php

namespace App\Imports;

use App\Repositories\BookRepositoryInterface;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class BooksImport implements ToCollection, WithChunkReading, ShouldQueue, WithProgressBar
{
    use Importable;

    public function __construct(
        private readonly BookRepositoryInterface     $bookRepository,
        private readonly CategoryRepositoryInterface $categoryRepository
    )
    {
    }

    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            $bookTitle = $row[0];
            $authorName = $row[1];
            $categoryTitle = $row[3];
            $category = $this->categoryRepository->findByTitle($categoryTitle);

            if (!$category) {
                $category = $this->categoryRepository->create(['title' => $categoryTitle]);
            }

            $book = $this->bookRepository->findByTitle($bookTitle);
            if ($book) {
                continue;
            }

            $this->bookRepository->create([
                'title' => $bookTitle,
                'author' => $authorName,
                'rating' => 0,
                'category_id' => $category->id
            ]);
        }
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
