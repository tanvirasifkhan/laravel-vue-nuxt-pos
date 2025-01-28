<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(6),
            'category_id' => fake()->randomElement(Category::pluck('id')),
            'per_unit_price' => fake()->randomFloat(2, 1, 20),
            'sku' => fake()->regexify('[A-Z]{5}[0-4]{3}'),
            'quantity' => 0
        ];
    }
}
