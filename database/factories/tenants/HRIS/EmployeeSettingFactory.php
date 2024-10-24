<?php

namespace Database\Factories\tenants\HRIS;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EmployeeSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'salary' => rand(1000, 10000000),
            'salary_type' => $this->faker->randomElement(['monthly', 'daily', 'hourly']),
            'employment_type' => $this->faker->randomElement(['regular', 'part-time', 'contract', 'probationary']),
            'tax' => rand(1, 50),
            'start_date' => $this->faker->date(),
            'regular_date' => $this->faker->date(),
            'resign_date' => $this->faker->date(),
            'can_overtime' => $this->faker->boolean(),
            'is_active' => $this->faker->boolean(),
            'data' => json_encode(['key' => 'value']),
        ];
    }
}
