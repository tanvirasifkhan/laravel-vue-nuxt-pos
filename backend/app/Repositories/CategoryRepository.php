<?php

namespace App\Repositories;

use App\Interfaces\CommonInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;

class CategoryRepository implements CommonInterface
{
    /**
     * create new category
     *
     * @return Category
     */
    public function store(array $categoryData): Category
    {
        return Category::create($categoryData);
    }

    /**
     * fetch all categories
     *
     * @return Builder
     */
    public function all(): Builder
    {
        return Category::orderBy('id', 'DESC');
    }

    /**
     * fetch category details by id
     *
     * @return Category/NULL
     */
    public function fetch(int $id): Category | NULL
    {
        return Category::where('id', $id)->first();
    }

    /**
     * update category by id
     *
     * @return true
     */
    public function update(int $id, array $updatedCategoryData): bool
    {
        return Category::where('id', $id)->update($updatedCategoryData);
    }

    /**
     * delete category by id
     *
     * @return true
     */
    public function delete(int $id): bool
    {
        return Category::where('id', $id)->delete();
    }
}
