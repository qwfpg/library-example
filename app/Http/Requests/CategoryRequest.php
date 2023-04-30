<?php

namespace App\Http\Requests;

class CategoryRequest extends BaseRequest
{

    protected function commonRules(): array
    {
        return [
            'title' => 'max:255'
        ];
    }

    protected function requiredFields(): array
    {
        return [];
    }
}
