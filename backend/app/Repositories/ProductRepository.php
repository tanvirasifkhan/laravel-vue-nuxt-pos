<?php

namespace App\Repositories;

use App\Interfaces\CommonInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class ProductRepository implements CommonInterface
{
    /**
     * create new product
     *
     * @return Product
     */
    public function store(array $productData): Product
    {
        return Product::create($productData);
    }

    /**
     * fetch all products
     *
     * @return Builder
     */
    public function all(): Builder
    {
        return Product::orderBy('id', 'DESC');
    }

    /**
     * fetch all products by search
     *
     * @return Builder
     */
    public function search(string $keyword): Builder
    {
        return Product::where('name', 'LIKE', '%' . strtolower($keyword) . '%')
            ->orWhere('sku', 'LIKE', '%' . strtolower($keyword) . '%');
    }

    /**
     * fetch product details by id
     *
     * @return Product/NULL
     */
    public function fetch(int $id): Product | NULL
    {
        return Product::where('id', $id)->first();
    }

    /**
     * update product by id
     *
     * @return true
     */
    public function update(int $id, array $updatedProductData): bool
    {
        return Product::where('id', $id)->update($updatedProductData);
    }

    /**
     * delete product by id
     *
     * @return true
     */
    public function delete(int $id): bool
    {
        return Product::where('id', $id)->delete();
    }
}
