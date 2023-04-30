<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends CategoryRequest
{
    protected function requiredFields(): array
    {
        return ['title'];
    }
}
