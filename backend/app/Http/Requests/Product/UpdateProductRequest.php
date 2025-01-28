<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Product;

class UpdateProductRequest extends FormRequest
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

        $product = Product::where('id', $this->id)->first();

        if($product != NULL){
            return [
                'name' => 'required',
                'category_id' => 'nullable|integer',
                'sku' => ['required', Rule::unique('products')->ignore($this->id)],
                'per_unit_price' => 'required|numeric',
                'quantity' => 'nullable|integer'
            ];
        }else {
            return [];
        }
    }

    /**
     * Custom validation messages
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => "What's the product's name ?",
            'category_id.integer' => "Please select a valid category.",
            'per_unit_price.required' => "What's the product's price ?",
            'per_unit_price.numeric' => "Price has to be numeric.",
            'quantity.integer' => "Please provide a valid quantity.",
            'sku.required' => "What's the product's SKU ?",
            'sku.unique' => "This SKU is already in use."
        ];
    }
}
