<?php

namespace Database\Factories\Tenants\HRIS;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parent_id'   => 0,
            '_lft'        => 0,
            '_rgt'        => 0,
            'name'        => $this->faker->name(),
            'description' => $this->faker->sentence(),
        ];
    }
}
