<?php

namespace App\Repositories;

use App\Interfaces\PurchaseInterface;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class PurchaseRepository implements PurchaseInterface
{
    public function store(array $data): Purchase
    {
        return Purchase::create($data);
    }

    public function all(): Builder
    {
        return Purchase::orderBy('id', 'DESC');
    }

    public function fetch(int $id): Purchase | NULL
    {
        return Purchase::where('id', $id)->first();
    }

    public function search(string $date): Builder
    {
        return Purchase::where('date', $date);
    }

    public function storeItems(int $purchaseId, string $purchaseItems): void
    {
        $total = 0;

        foreach (json_decode($purchaseItems) as $item) {
            $product = Product::where('id', $item->product_id)->first();

            PurchaseItem::create([
                'purchase_id' => $purchaseId,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $product->per_unit_price,
                'total' => $item->quantity * $product->per_unit_price
            ]);

            $total += $item->quantity * $product->per_unit_price;

            $this->updateProductQuantity($item->product_id, $item->quantity);

            $this->updatePurchaseTotalAmount($purchaseId, $total);
        }
    }

    public function updateProductQuantity(int $productId, int $quantity): bool
    {
        $product = Product::where('id', $productId)->first();

        $product->quantity += $quantity;

        return $product->save();
    }

    public function updatePurchaseTotalAmount(int $purchaseId, float $total): bool
    {
        $purchase = Purchase::where('id', $purchaseId)->first();

        $purchase->total = $total;

        return $purchase->save();
    }
}
