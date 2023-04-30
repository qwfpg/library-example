<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends BaseRequest
{
    protected function commonRules(): array
    {
        return [
            'title' => 'max:255',
            'author' => 'max:255',
            'description' => 'nullable',
            'cover' => 'nullable|image',
            'rating' => 'numeric|between:0,5',
            'category_id' => 'exists:categories,id',
        ];
    }

    protected function requiredFields(): array
    {
        return [];
    }
}
