<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Supplier;

class UpdateSupplierRequest extends FormRequest
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
        $supplier = Supplier::where('id', $this->id)->first();

        if($supplier != NULL){
            return [
                'name' => 'required',
                'email' => ['nullable', 'email', Rule::unique('suppliers')->ignore($this->id)],
                'phone' => ['required', 'numeric', Rule::unique('suppliers')->ignore($this->id)],
                'address' => 'nullable'
            ];
        }else{
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
            'name.required' => "What's the supplier's name ?",
            'email.email' => "Please provide a valid email address.",
            'email.unique' => "This email address is already in use.",
            'phone.required' => "What's the supplier's phone number ?",
            'phone.numeric' => "Please provide a valid phone number.",
            'phone.unique' => "This phone number is already in use."
        ];
    }
}
