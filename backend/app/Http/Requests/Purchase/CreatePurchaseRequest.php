<?php

namespace App\Http\Requests\Purchase;

use Illuminate\Foundation\Http\FormRequest;

class CreatePurchaseRequest extends FormRequest
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
            'date' => 'required|date',
            'supplier_id' => 'required|integer|exists:suppliers,id',
            'items' => 'required',
            'items.*.product_id' => 'required|integer|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'date.required' => 'The date field is required.',
            'date.date' => 'The date must be a valid date (YEAR-MONTH-DAY).',
            'supplier_id.required' => 'Select a supplier.',
            'supplier_id.integer' => 'The selected supplier is invalid.',
            'supplier_id.exists' => 'The selected supplier does not exist.',
            'items.required' => 'Add at least one item.',
            'items.*.product_id.required' => 'Select a product.',
            'items.*.product_id.integer' => 'The selected product is invalid.',
            'items.*.product_id.exists' => 'The selected product is invalid.',
            'items.*.quantity.min' => 'The quantity must be at least 1.'
        ];
    }
}
