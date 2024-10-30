<?php

namespace Database\Factories\tenants\HRIS;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\tenants\HRIS\EmployeeBenefit>
 */
class EmployeeBenefitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employer_weight' => rand(1, 100),
            'employee_weight' => rand(1, 100),
        ];
    }
}
