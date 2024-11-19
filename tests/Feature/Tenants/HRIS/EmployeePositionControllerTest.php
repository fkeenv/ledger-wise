<?php

namespace Tests\Feature\Tenants\HRIS;

use Tests\TestCase;
use App\Models\Tenants\User;
use App\Models\Tenants\HRIS\Employee;
use App\Models\Tenants\HRIS\Position;
use App\Models\Tenants\HRIS\Department;
use Illuminate\Database\Eloquent\Factories\Sequence;

class EmployeePositionControllerTest extends TestCase
{
    protected $tenancy = true;

    public function test_can_read_employees_with_positions(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $employee = Employee::factory()->create();
        $department = Department::factory()->create();
        $position = Position::factory()->create([
            'department_id' => $department->id,
        ]);
        $employee->positions()->attach($position->id);

        $response = $this->actingAs($user)->get("/api/hris/employees/{$employee->id}/positions");

        $response
            ->assertJsonStructure([
                0 => [
                    'id',
                    'first_name',
                    'middle_name',
                    'last_name',
                    'gender',
                    'mobile_number',
                    'birth_date',
                    'created_at',
                    'updated_at',
                    'positions' => [
                        0 => [
                            'id',
                            'department_id',
                            'name',
                            'description',
                            '_lft',
                            '_rgt',
                            'parent_id',
                            'created_at',
                            'updated_at',
                            'pivot' => [
                                'employee_id',
                                'position_id',
                            ],
                        ],
                    ],
                ],
            ])
            ->assertStatus(200);
    }

    public function test_can_read_an_employee_with_specific_position(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $employee = Employee::factory()->create();
        $department = Department::factory()->create();
        $position = Position::factory()->create([
            'department_id' => $department->id,
        ]);
        $employee->positions()->attach($position->id);

        $response = $this->actingAs($user)->get("/api/hris/employees/{$employee->id}/positions/{$position->id}");

        $response
            ->assertJsonStructure([
                'id',
                'first_name',
                'middle_name',
                'last_name',
                'gender',
                'mobile_number',
                'birth_date',
                'created_at',
                'updated_at',
                'positions' => [
                    0 => [
                        'id',
                        'department_id',
                        'name',
                        'description',
                        '_lft',
                        '_rgt',
                        'parent_id',
                        'created_at',
                        'updated_at',
                        'pivot' => [
                            'employee_id',
                            'position_id',
                        ],
                    ],
                ],
            ])
            ->assertStatus(200);
    }

    public function test_can_assign_positions_to_an_employee(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $employee = Employee::factory()->create();
        $department = Department::factory()->create();
        $position = Position::factory(2)->state(new Sequence(function () use ($department) {
            return ['department_id' => $department->id];
        }))->create();
        $data = [
            'position_ids' => $position->pluck('id')->toArray(),
        ];

        $response = $this->actingAs($user)->post("/api/hris/employees/{$employee->id}/positions", $data);

        $response
            ->assertJsonStructure([
                'id',
                'first_name',
                'middle_name',
                'last_name',
                'gender',
                'mobile_number',
                'birth_date',
                'created_at',
                'updated_at',
                'positions' => [
                    0 => [
                        'id',
                        'department_id',
                        'name',
                        'description',
                        '_lft',
                        '_rgt',
                        'parent_id',
                        'created_at',
                        'updated_at',
                        'pivot' => [
                            'employee_id',
                            'position_id',
                        ],
                    ],
                ],
            ])
            ->assertStatus(200);
    }
}
