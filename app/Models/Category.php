<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends SluggableModel
{
    use HasFactory;

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
    protected $fillable = [
        'title'
    ];

    protected function getSluggableValue(): string
    {
        return $this->title;
    }
}
