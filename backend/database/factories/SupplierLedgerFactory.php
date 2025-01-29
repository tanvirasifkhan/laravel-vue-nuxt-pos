<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Supplier;
use App\Models\Purchase;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SupplierLedger>
 */
class SupplierLedgerFactory extends Factory
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
            'supplier_id' => fake()->randomElement(Supplier::pluck('id')),
            'transaction_date' => fake()->date(),
            'type' => $this->faker->randomElement(['debit', 'credit']),
            'debited_amount' => fake()->randomFloat(2, 1, 1000),
            'credited_amount' => fake()->randomFloat(2, 1, 1000),
            'description' => fake()->text()
        ];
    }
}
