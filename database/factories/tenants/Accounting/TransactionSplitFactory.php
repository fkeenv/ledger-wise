<?php

namespace Database\Factories\tenants\Accounting;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TransactionSplitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount'     => $this->faker->randomNumber(),
            'type'       => $this->faker->randomElement(['debit', 'credit']),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
