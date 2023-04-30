<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{
    abstract protected function commonRules(): array;

    abstract protected function requiredFields(): array;

    public function rules(): array
    {
        $rules = $this->commonRules();
        $requiredFields = $this->requiredFields();

        foreach ($requiredFields as $field) {
            if (array_key_exists($field, $rules)) {
                $rules[$field] = 'required|' . $rules[$field];
            }
        }

        return $rules;
    }
}
