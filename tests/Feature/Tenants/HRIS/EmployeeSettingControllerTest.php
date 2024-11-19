<?php

namespace Tests\Feature\Tenants\HRIS;

use Tests\TestCase;
use App\Models\Tenants\User;
use App\Models\Tenants\HRIS\Employee;
use App\Models\Tenants\HRIS\EmployeeSetting;

class EmployeeSettingControllerTest extends TestCase
{
    protected $tenancy = true;

    public function test_can_read_employee_settings(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $employee = Employee::factory()->create();
        $employee = EmployeeSetting::factory()->create(['employee_id' => $employee->id]);

        $response = $this->actingAs($user)->get("/api/hris/employees/{$employee->id}/settings");

        $response
            ->assertJsonStructure([
                0 => [
                    'id',
                    'employee_id',
                    'salary',
                    'salary_type',
                    'tax',
                    'employment_type',
                    'start_date',
                    'regular_date',
                    'resign_date',
                    'can_overtime',
                    'is_active',
                    'data',
                    'created_at',
                    'updated_at',
                ],
            ])
            ->assertStatus(200);
    }

    public function test_can_read_an_employee_setting(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $employee = Employee::factory()->create();
        $employeeSetting = EmployeeSetting::factory()->create(['employee_id' => $employee->id]);

        $response = $this->actingAs($user)->get("/api/hris/employees/{$employee->id}/settings/{$employeeSetting->id}");

        $response
            ->assertJsonStructure([
                'id',
                'employee_id',
                'salary',
                'salary_type',
                'tax',
                'employment_type',
                'start_date',
                'regular_date',
                'resign_date',
                'can_overtime',
                'is_active',
                'data',
                'created_at',
                'updated_at',
            ])
            ->assertStatus(200);
    }

    public function test_can_create_an_employee_setting(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $employee = Employee::factory()->create();
        $data = [
            'salary' => 1000,
            'salary_type' => 'monthly',
            'tax' => 10,
            'employment_type' => 'regular',
            'start_date' => '2021-01-01',
            'regular_date' => '2021-01-01',
            'resign_date' => '2021-01-01',
            'can_overtime' => true,
            'is_active' => true,
            'data' => ['key' => 'value'],
        ];

        $response = $this->actingAs($user)->post("/api/hris/employees/{$employee->id}/settings", $data);
        $responseData = $response->getData();

        $response
            ->assertJsonStructure([
                'id',
                'employee_id',
                'salary',
                'salary_type',
                'tax',
                'employment_type',
                'start_date',
                'regular_date',
                'resign_date',
                'can_overtime',
                'is_active',
                'data',
                'created_at',
                'updated_at',
            ])
            ->assertStatus(201);

        $this->assertEquals($data['salary'], $responseData->salary);
        $this->assertEquals($data['salary_type'], $responseData->salary_type);
        $this->assertEquals($data['tax'], $responseData->tax);
        $this->assertEquals($data['employment_type'], $responseData->employment_type);
        $this->assertEquals($data['start_date'], $responseData->start_date);
        $this->assertEquals($data['regular_date'], $responseData->regular_date);
        $this->assertEquals($data['resign_date'], $responseData->resign_date);
        $this->assertEquals($data['can_overtime'], $responseData->can_overtime);
        $this->assertEquals($data['is_active'], $responseData->is_active);
        $this->assertNotEmpty($responseData->data);
    }

    public function test_can_update_an_employee_setting(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $employee = Employee::factory()->create();
        $employeeSetting = EmployeeSetting::factory()->create(['employee_id' => $employee->id]);
        $data = [
            'salary' => 1000,
            'salary_type' => 'monthly',
            'tax' => 10,
            'employment_type' => 'regular',
            'start_date' => '2021-01-01',
            'regular_date' => '2021-01-01',
            'resign_date' => '2021-01-01',
            'can_overtime' => true,
            'is_active' => true,
            'data' => null,
        ];

        $response = $this->actingAs($user)->patch("/api/hris/employees/{$employee->id}/settings/{$employeeSetting->id}", $data);
        $responseData = $response->getData();

        $response
            ->assertJsonStructure([
                'id',
                'employee_id',
                'salary',
                'salary_type',
                'tax',
                'employment_type',
                'start_date',
                'regular_date',
                'resign_date',
                'can_overtime',
                'is_active',
                'data',
                'created_at',
                'updated_at',
            ])
            ->assertStatus(200);

        $this->assertEquals($data['salary'], $responseData->salary);
        $this->assertEquals($data['salary_type'], $responseData->salary_type);
        $this->assertEquals($data['tax'], $responseData->tax);
        $this->assertEquals($data['employment_type'], $responseData->employment_type);
        $this->assertEquals($data['start_date'], $responseData->start_date);
        $this->assertEquals($data['regular_date'], $responseData->regular_date);
        $this->assertEquals($data['resign_date'], $responseData->resign_date);
        $this->assertEquals($data['can_overtime'], $responseData->can_overtime);
        $this->assertEquals($data['is_active'], $responseData->is_active);
        $this->assertNull($responseData->data);
    }

    public function test_can_delete_an_employee_setting(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $employee = Employee::factory()->create();
        $employeeSetting = EmployeeSetting::factory()->create(['employee_id' => $employee->id]);

        $response = $this->actingAs($user)->delete("/api/hris/employees/{$employee->id}/settings/{$employeeSetting->id}");

        $response
            ->assertJsonStructure([
                'id',
                'employee_id',
                'salary',
                'salary_type',
                'tax',
                'employment_type',
                'start_date',
                'regular_date',
                'resign_date',
                'can_overtime',
                'is_active',
                'data',
                'created_at',
                'updated_at',
            ])
            ->assertStatus(200);


        $this->assertDatabaseCount('employee_settings', 0);
    }
}
