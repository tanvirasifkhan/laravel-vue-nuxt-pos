<?php

namespace App\Repositories;

use App\Interfaces\SupplierLedgerInterface;
use App\Models\Purchase;
use App\Models\SupplierLedger;
use Illuminate\Database\Eloquent\Builder;

class SupplierLedgerRepository implements SupplierLedgerInterface
{
    /**
     * create new default ledger just after purchase as credit
     *
     * @return SupplierLedger
     */
    public function storeDefault(Purchase $purchase): SupplierLedger
    {
        return SupplierLedger::create([
            'purchase_id' => $purchase->id,
            'supplier_id' => $purchase->supplier_id,
            'transaction_date' => $purchase->date,
            'type' => 'credit',
            'credited_amount' => $purchase->total,
            'description' => 'Supplier ledger created after purchase.'
        ]);
    }

    /**
     * create new ledger during purchase payment as debit
     *
     * @return SupplierLedger
     */
    public function store(array $supplierLedgerData): SupplierLedger
    {
        return SupplierLedger::create($supplierLedgerData);
    }

    /**
     * fetch all supplier ledgers
     *
     * @return Builder
     */
    public function all(): Builder
    {
        return SupplierLedger::orderBy('id', 'DESC');
    }

    /**
     * fetch ledger details by id
     *
     * @return SupplierLedger/NULL
     */
    public function fetch(int $id): SupplierLedger | NULL
    {
        return SupplierLedger::where('id', $id)->first();
    }

    /**
     * fetch ledger details by supplier id and purchase id
     *
     * @return SupplierLedger/NULL
     */
    public function fetchBy(int $supplierId, int $purchaseId): SupplierLedger | NULL
    {
        return SupplierLedger::where('supplier_id', $supplierId)
            ->where('purchase_id', $purchaseId)
            ->orderBy('id', 'DESC')->first();
    }

    /**
     * fetch all ledgers by search using date range
     *
     * @return Builder
     */
    public function search(string $date_from, string $date_to): Builder
    {
        return SupplierLedger::whereBetween('transaction_date', [date($date_from), date($date_to)]);
    }
}
