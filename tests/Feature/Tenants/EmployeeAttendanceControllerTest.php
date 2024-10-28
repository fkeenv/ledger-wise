<?php

namespace Tests\Feature\Tenants;

use Tests\TestCase;
use App\Models\Tenants\User;
use App\Models\Tenants\HRIS\Employee;
use App\Models\Tenants\HRIS\Attendance;

class EmployeeAttendanceControllerTest extends TestCase
{
    protected $tenancy = true;

    public function test_can_read_attendances(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $employee = Employee::factory()->create();
        Attendance::factory()->create([
            'recordable_id' => $employee->id,
            'recordable_type' => get_class($employee),
        ]);

        $response = $this->actingAs($user)->get("/api/hris/employees/{$employee->id}/attendances");

        $response
            ->assertJsonStructure([
                0 => [
                    'id',
                    'recordable_type',
                    'recordable_id',
                    'date',
                    'created_at',
                    'updated_at',
                    'records',
                ],
            ])
            ->assertStatus(200);
    }

    public function test_can_read_an_attendance(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $employee = Employee::factory()->create();
        $attendance = Attendance::factory()->create([
            'recordable_id' => $employee->id,
            'recordable_type' => get_class($employee),
        ]);

        $response = $this->actingAs($user)->get("/api/hris/employees/{$employee->id}/attendances/{$attendance->id}");

        $response
            ->assertJsonStructure([
                'id',
                'recordable_type',
                'recordable_id',
                'date',
                'created_at',
                'updated_at',
                'records',
            ])
            ->assertStatus(200);
    }

    public function test_can_create_an_attendance(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $employee = Employee::factory()->create();
        $data = [
            'time' => now(),
        ];

        $response = $this->actingAs($user)->post("/api/hris/employees/{$employee->id}/attendances", $data);

        $response
            ->assertJsonStructure(
                [
                    'id',
                    'recordable_id',
                    'recordable_type',
                    'date',
                    'created_at',
                    'updated_at',
                    'records',
                ]
            )
            ->assertStatus(200);
    }

    public function test_can_update_an_attendance(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $employee = Employee::factory()->create();
        $attendance = Attendance::factory()->create([
            'recordable_id' => $employee->id,
            'recordable_type' => get_class($employee),
        ]);
        $enum = ['pause', 'continue', 'stop'];
        $rand = rand(0, 2);
        $data = [
            'time' => now(),
            'type' => $enum[$rand],
        ];

        $response = $this->actingAs($user)->patch("/api/hris/employees/{$employee->id}/attendances/{$attendance->id}", $data);

        $response
            ->assertJsonStructure(
                [
                    'id',
                    'recordable_id',
                    'recordable_type',
                    'date',
                    'created_at',
                    'updated_at',
                    'records',
                ]
            )
            ->assertStatus(200);
    }

    public function test_can_delete_an_attendance(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $employee = Employee::factory()->create();
        $attendance = Attendance::factory()->create([
            'recordable_id' => $employee->id,
            'recordable_type' => get_class($employee),
        ]);

        $response = $this->actingAs($user)->delete("/api/hris/employees/{$employee->id}/attendances/{$attendance->id}");

        $response
            ->assertJsonStructure(
                [
                    'id',
                    'recordable_id',
                    'recordable_type',
                    'date',
                    'created_at',
                    'updated_at',
                ]
            )
            ->assertStatus(200);
    }
}
