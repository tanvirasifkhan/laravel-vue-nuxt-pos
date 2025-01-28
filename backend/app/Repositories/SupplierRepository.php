<?php

namespace App\Repositories;

use App\Interfaces\CommonInterface;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Builder;


class SupplierRepository implements CommonInterface
{
    /**
     * create new supplier
     *
     * @return Supplier
     */
    public function store(array $supplierData): Supplier
    {
        return Supplier::create($supplierData);
    }

    /**
     * fetch all suppliers
     *
     * @return Builder
     */
    public function all(): Builder
    {
        return Supplier::orderBy('id', 'DESC');
    }

    /**
     * fetch all suppliers by search
     *
     * @return Builder
     */
    public function search(string $keyword): Builder
    {
        return Supplier::where('name', 'LIKE', '%' . strtolower($keyword) . '%')
            ->orWhere('email', 'LIKE', '%' . strtolower($keyword) . '%')
            ->orWhere('phone', 'LIKE', '%' . strtolower($keyword) . '%')
            ->orWhere('address', 'LIKE', '%' . strtolower($keyword) . '%');
    }

    /**
     * fetch supplier details by id
     *
     * @return Supplier/NULL
     */
    public function fetch(int $id): Supplier | NULL
    {
        return Supplier::where('id', $id)->first();
    }

    /**
     * update supplier by id
     *
     * @return true
     */
    public function update(int $id, array $updatedSupplierData): bool
    {
        return Supplier::where('id', $id)->update($updatedSupplierData);
    }

    /**
     * delete supplier by id
     *
     * @return true
     */
    public function delete(int $id): bool
    {
        return Supplier::where('id', $id)->delete();
    }
}
