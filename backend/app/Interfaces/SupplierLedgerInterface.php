<?php

namespace App\Interfaces;

use App\Models\Purchase;
use App\Models\SupplierLedger;
use Illuminate\Database\Eloquent\Builder;

interface SupplierLedgerInterface
{
    public function storeDefault(Purchase $purchase): SupplierLedger;
    public function store(array $data): SupplierLedger;
    public function all(): Builder;
    public function fetch(int $id): SupplierLedger | NULL;
    public function fetchBy(int $supplierId, int $purchaseId): SupplierLedger | NULL;
    public function search(string $date_from, string $date_to): Builder;
}
