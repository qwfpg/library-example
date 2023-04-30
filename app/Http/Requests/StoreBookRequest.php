<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends BookRequest
{
    protected function requiredFields(): array
    {
        return ['title', 'author', 'category_id'];
    }
}
