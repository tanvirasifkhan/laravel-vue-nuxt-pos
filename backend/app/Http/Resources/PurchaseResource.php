<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SupplierResource;
use App\Http\Resources\PurchaseItemResource;

class PurchaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'date' => [
                'raw' => $this->date,
                'human' => date_format(date_create($this->date), format: 'jS F, Y')
            ],
            'supplier' => new SupplierResource($this->supplier),
            'items' => PurchaseItemResource::collection($this->purchaseItems),
            'total' => $this->total
        ];
    }
}
