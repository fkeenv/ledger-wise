<?php

namespace Database\Factories\tenants\Accounting;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name'  => $this->faker->firstName,
            'middle_name' => $this->faker->lastName,
            'last_name'   => $this->faker->lastName,
            'email'       => $this->faker->unique()->safeEmail,
            'mobile'      => $this->faker->phoneNumber,
            'notes'       => $this->faker->sentence,
            'is_active'   => $this->faker->boolean,
            'is_taxable'  => $this->faker->boolean,
        ];
    }
}
