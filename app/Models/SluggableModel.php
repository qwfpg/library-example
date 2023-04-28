<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

abstract class SluggableModel extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = $model->generateUniqueSlug($model->getSluggableValue());
        });
    }

    protected function generateUniqueSlug(string $sluggableValue): string
    {
        $slug = Str::slug($sluggableValue);
        $newSlug = $slug;
        $i = 1;

        while (self::where('slug', $newSlug)->exists()) {
            $newSlug = "{$slug}-" . $i++;
        }

        return $newSlug;
    }

    abstract protected function getSluggableValue(): string;
}
