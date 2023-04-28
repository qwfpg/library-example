<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->sentence(5);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'author' => $this->faker->name,
            'description' => $this->faker->paragraph,
            'rating' => $this->faker->numberBetween(1, 5),
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}
