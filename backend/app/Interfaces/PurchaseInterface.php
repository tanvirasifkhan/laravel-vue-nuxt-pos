<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Purchase;

interface PurchaseInterface
{
    public function store(array $data): Purchase;
    public function all(): Builder;
    public function fetch(int $id): Purchase | NULL;
    public function search(string $date): Builder;
    public function storeItems(int $purchaseId, string $purchaseItems): void;
    public function updateProductQuantity(int $productId, int $quantity): bool;
    public function updatePurchaseTotalAmount(int $purchaseId, float $total): bool;
}
