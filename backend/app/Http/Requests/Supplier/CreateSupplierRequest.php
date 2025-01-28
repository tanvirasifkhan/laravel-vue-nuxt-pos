<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class CreateSupplierRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'nullable|email|unique:suppliers',
            'phone' => 'required|numeric|unique:suppliers',
            'address' => 'nullable'
        ];
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
