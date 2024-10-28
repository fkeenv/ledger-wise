<?php

namespace Database\Seeders\Tenants\HRIS;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Models\Tenants\HRIS\Employee;
use App\Models\Tenants\HRIS\Position;
use App\Models\Tenants\HRIS\EmploymentBenefit;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $employee = Employee::factory()->create();
        $position = Position::factory()->create();
        $employmentBenefit = EmploymentBenefit::factory()->create();
        $employee->positions()->attach($position->id);
        $employee->benefits()->attach($employmentBenefit->id, [
            'employer_weight' => 0.5,
            'employee_weight' => 0.5,
            'data' => ['foo' => 'bar'],
        ]);
        $employee->setting()->create([
            'salary' => rand(1000, 10000000),
            'salary_type' => $faker->randomElement(['monthly', 'daily', 'hourly']),
            'employment_type' => $faker->randomElement(['regular', 'part-time', 'contract', 'probationary']),
            'tax' => rand(1, 50),
            'start_date' => $faker->date(),
            'regular_date' => $faker->date(),
            'resign_date' => $faker->date(),
            'can_overtime' => $faker->boolean(),
            'is_active' => $faker->boolean(),
            'data' => json_encode(['key' => 'value']),
        ]);

        for ($i = 20; $i = 20; $i++) {
            $employee->attendances()->create([
                'date' => $faker->date(),
                'time_in' => $faker->time(),
                'time_out' => $faker->time(),
                'data' => json_encode(['key' => 'value']),
            ]);
        }
    }
}
