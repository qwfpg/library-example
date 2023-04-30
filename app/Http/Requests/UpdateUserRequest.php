<?php

namespace App\Http\Requests;

class UpdateUserRequest extends UserRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'email' => 'string|email|max:255|unique:users,email,' . $this->user->id,
        ]);
    }
}
