<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends SluggableModel
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'description',
        'rating',
        'cover',
        'category_id'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }

    public function getCover(): string
    {
        if (!$this->cover) {
            return asset('images/default-cover.jpg');
        }
        return asset('storage/' . $this->cover);
    }

    protected function getSluggableValue(): string
    {
        return $this->title;
    }
}
