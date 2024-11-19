<?php

namespace Tests\Feature\Tenants\HRIS;

use Tests\TestCase;
use App\Models\Tenants\User;
use App\Models\Tenants\HRIS\Employee;
use App\Models\Tenants\HRIS\EmployeeBenefit;
use App\Models\Tenants\HRIS\EmployeeSetting;
use App\Models\Tenants\HRIS\EmploymentBenefit;

class EmployeeSalaryControllerTest extends TestCase
{
    protected $tenancy = true;

    public function test_can_read_an_employee_salary(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $employee = Employee::factory()->create();
        EmployeeSetting::factory()->create(['employee_id' => $employee->id]);
        $employmentBenefit = EmploymentBenefit::factory()->create();
        EmployeeBenefit::factory()->create([
            'employee_id' => $employee->id,
            'employment_benefit_id' => $employmentBenefit->id,
        ]);
        $attendance = $employee->attendances()->create([
            'date' => now(),
        ]);
        $attendance->records()->createMany([
            [
                'time' => now(),
                'type' => 'start',
            ],
            [
                'time' => now()->addHours(8),
                'type' => 'stop',
            ],
        ]);
        $this->actingAs($user)->post("/api/hris/employees/{$employee->id}/salaries", [
            'cut_off' => now()->format('Y-m-d'),
        ]);

        $response = $this->actingAs($user)->get("/api/hris/employees/{$employee->id}/salaries");

        $response
            ->assertJsonStructure([
                0 => [
                    'id',
                    'employee_id',
                    'gross_salary',
                    'net_salary',
                    'tax_amount',
                    'salary_rate',
                    'total_days_worked',
                    'total_minutes_late',
                    'cut_off_start',
                    'cut_off_end',
                    'date_generated',
                    'benefits',
                    'created_at',
                    'updated_at',
                ],
            ])
            ->assertStatus(200);
    }

    public function test_can_create_an_employee_salary(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $employee = Employee::factory()->create();
        EmployeeSetting::factory()->create(['employee_id' => $employee->id]);
        $employmentBenefit = EmploymentBenefit::factory()->create();
        EmployeeBenefit::factory()->create([
            'employee_id' => $employee->id,
            'employment_benefit_id' => $employmentBenefit->id,
        ]);
        $attendance = $employee->attendances()->create([
            'date' => now(),
        ]);
        $attendance->records()->createMany([
            [
                'time' => now(),
                'type' => 'start',
            ],
            [
                'time' => now()->addHours(8),
                'type' => 'stop',
            ],
        ]);
        $response = $this->actingAs($user)->post("/api/hris/employees/{$employee->id}/salaries", [
            'cut_off' => now()->format('Y-m-d'),
        ]);

        $response
            ->assertJsonStructure([
                'tax_amount',
                'gross_salary',
                'net_salary',
                'salary_rate',
                'total_days_worked',
                'total_minutes_late',
                'cut_off_start',
                'cut_off_end',
                'date_generated',
                'benefits',
                'employee_id',
                'updated_at',
                'created_at',
                'id',
            ])
            ->assertStatus(201);
    }
}
