<?php

namespace App\Http\Requests;

class UserRequest extends BaseRequest
{
    protected function commonRules(): array
    {
        return [
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email',
            'role' => 'string',
        ];
    }

    protected function requiredFields(): array
    {
        return [];
    }
}
