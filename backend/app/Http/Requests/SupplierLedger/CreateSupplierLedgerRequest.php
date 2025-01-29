<?php

namespace App\Http\Requests\SupplierLedger;

use Illuminate\Foundation\Http\FormRequest;

class CreateSupplierLedgerRequest extends FormRequest
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
            'purchase_id' => 'required|integer|exists:purchases,id',
            'supplier_id' => 'required|integer|exists:suppliers,id',
            'transaction_date' => 'required|date',
            'debited_amount' => 'required|numeric',
            'description' => 'nullable'
        ];
    }
}
