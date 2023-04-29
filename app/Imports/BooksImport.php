<?php

namespace App\Imports;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;

class BooksImport implements ToCollection
{
    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            $bookTitle = $row[0];
            $authorName = $row[1];
            $categoryTitle = $row[3];
            $category = Category::where('title', $categoryTitle)->first();

            if (!$category) {
                $category = new Category();
                $category->title = $categoryTitle;
                $category->slug = Str::slug($categoryTitle);
                $category->save();
            }

            $book = Book::where('title', $bookTitle)->first();
            if ($book) {
                continue;
            }
            $book = new Book([
                'title' => $bookTitle,
                'author' => $authorName,
                'slug' => Str::slug($bookTitle),
                'rating' => 1
            ]);

            $book->category_id = $category->id;
            $book->save();
        }
    }
}
