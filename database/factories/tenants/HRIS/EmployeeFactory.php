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
        $gender = $this->faker->randomElement(['male', 'female']);

        return [
            'first_name'    => $this->faker->firstName($gender),
            'middle_name'   => $this->faker->lastName(),
            'last_name'     => $this->faker->lastName(),
            'gender'        => $gender,
            'mobile_number' => $this->faker->phoneNumber(),
            'birth_date'    => $this->faker->date(),
        ];
    }
}
