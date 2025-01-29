<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierLedgerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $debitedAmount = number_format($this->debited_amount, 2, '.', '');
        $creditedAmount = number_format($this->credited_amount, 2, '.', '');

        return [
            'id' => $this->id,
            'supplier' => new SupplierResource($this->supplier),
            'purchase' => new PurchaseResource($this->purchase),
            'date' => [
                'raw' => $this->transaction_date,
                'human' => date_format(date_create($this->transaction_date), format: 'jS F, Y')
            ],
            'type' => $this->type,
            'debited_amount' => $debitedAmount,
            'credited_amount' => $creditedAmount,
            'balance' => number_format($this->credited_amount, 2, '.', ''),
            'status' => $this->credited_amount == 0 ? 'cleared' : 'pending',
            'description' => $this->description
        ];
    }
}
