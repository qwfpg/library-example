<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
//            'slug' => 'required|unique:books|max:255',
//            'author' => 'required|max:255',
//            'description' => 'nullable',
//            'rating' => 'nullable|numeric|between:0,5',
//            'cover' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
        ];
    }

}
