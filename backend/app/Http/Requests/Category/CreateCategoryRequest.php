<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|unique:categories',
            'slug' => 'required|unique:categories'
        ];
    }

    /**
     * Custom validation messages
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => "Category requires a title.",
            'title.unique' => "Category title has already been taken.",
            'slug.required' => "Category requires a slug.",
            'slug.unique' => "Category slug has already been taken."
        ];
    }
}
