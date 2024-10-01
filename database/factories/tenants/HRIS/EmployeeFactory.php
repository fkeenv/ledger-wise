<?php

namespace Database\Factories\tenants\HRIS;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\tenants\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $rand = rand(0, 1);
        $gender = ['male', 'female'];
        return [
            'first_name'    => $this->faker->firstName($gender[$rand]),
            'middle_name'   => $this->faker->lastName(),
            'last_name'     => $this->faker->lastName(),
            'gender'        => $gender[$rand],
            'mobile_number' => $this->faker->phoneNumber(),
            'birth_date'    => $this->faker->date(),
        ];
    }
}
