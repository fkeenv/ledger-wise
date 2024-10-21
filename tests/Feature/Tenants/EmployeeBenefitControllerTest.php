<?php

namespace Tests\Feature\Tenants;

use Tests\TestCase;
use App\Models\Tenants\User;
use App\Models\Tenants\HRIS\Employee;
use App\Models\Tenants\HRIS\EmploymentBenefit;

class EmployeeBenefitControllerTest extends TestCase
{
    protected $tenancy = true;

    /**
     * A basic feature test example.
     */
    public function test_can_read_employee_benefits(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $employee = Employee::factory()->create();
        $employmentBenefit = EmploymentBenefit::factory()->create();
        $employee->benefits()->attach($employmentBenefit->id, [
            'employer_weight' => 9.5,
            'employee_weight' => 4.5,
            'data' => null,
        ]);

        $response = $this->actingAs($user)->get("/api/hris/employees/{$employee->id}/benefits");

        $response
            ->assertJsonStructure([
                0 => [
                    'id',
                    'name',
                    'description',
                    'sector',
                    'type',
                    'created_at',
                    'updated_at',
                    'pivot' => [
                        'employee_id',
                        'employment_benefit_id',
                        'employer_weight',
                        'employee_weight',
                        'data',
                    ],
                ],
            ])
            ->assertStatus(200);
    }

    public function test_can_create_an_employee_benefit(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $employee = Employee::factory()->create();
        $employmentBenefit = EmploymentBenefit::factory()->create();
        $data = [
            'employment_benefit_id' => $employmentBenefit->id,
            'employer_weight' => 9.5,
            'employee_weight' => 4.5,
            'meta' => null,
        ];

        $response = $this->actingAs($user)->post("/api/hris/employees/{$employee->id}/benefits", $data);
        $responseData = $response->getData();

        $response
            ->assertJsonStructure([
                'id',
                'name',
                'description',
                'sector',
                'type',
                'created_at',
                'updated_at',
                'pivot' => [
                    'employee_id',
                    'employment_benefit_id',
                    'employer_weight',
                    'employee_weight',
                    'data',
                ],
            ])
            ->assertStatus(200);

        $this->assertEquals($data['employment_benefit_id'], $responseData->pivot->employment_benefit_id);
        $this->assertEquals($data['employer_weight'], $responseData->pivot->employer_weight);
        $this->assertEquals($data['employee_weight'], $responseData->pivot->employee_weight);
    }

    public function test_can_delete_an_employee_benefit(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $employee = Employee::factory()->create();
        $employmentBenefit = EmploymentBenefit::factory()->create();
        $employee->benefits()->attach($employmentBenefit->id, [
            'employer_weight' => 9.5,
            'employee_weight' => 4.5,
            'data' => null,
        ]);
        $employeeBenefit = $employee->benefits()->where(function ($query) use ($employee, $employmentBenefit) {
            return $query
                ->where('employee_id', $employee->id)
                ->where('employment_benefit_id', $employmentBenefit->id);
        })->first();

        $response = $this->actingAs($user)->delete("/api/hris/employees/{$employee->id}/benefits/{$employeeBenefit->id}");

        $response->assertStatus(200);
    }
}
