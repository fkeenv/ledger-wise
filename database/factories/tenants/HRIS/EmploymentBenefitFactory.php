<?php

namespace Database\Factories\tenants\HRIS;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EmploymentBenefitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'sector' => $this->faker->randomElement(['government', 'private']),
            'type' => $this->faker->randomElement(['mandatory', 'optional']),
        ];
    }
}
