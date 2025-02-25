<?php

namespace Database\Factories\tenants\Accounting;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reference'   => $this->faker->uuid(),
            'description' => $this->faker->text(),
            'date'        => $this->faker->dateTime()
        ];
    }
}
