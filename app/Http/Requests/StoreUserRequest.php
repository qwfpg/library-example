<?php

namespace App\Http\Requests;

class StoreUserRequest extends UserRequest
{
    protected function requiredFields(): array
    {
        return ['name', 'email', 'role'];
    }
}
