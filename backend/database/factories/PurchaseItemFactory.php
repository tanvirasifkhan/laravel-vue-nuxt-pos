<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PurchaseItem>
 */
class PurchaseItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'purchase_id' => fake()->randomElement(Purchase::pluck('id')),
            'product_id' => fake()->randomElement(Product::pluck('id')),
            'quantity' => fake()->randomDigitNot(0),
            'price' => fake()->randomFloat(2, 1, 20),
            'total' => fake()->randomFloat(2, 1, 20)
        ];
    }
}
