<?php

namespace Tests\Feature\Tenants;

use Faker\Factory;
use Tests\TestCase;
use App\Models\Tenants\User;
use App\Models\Tenants\Department;

class DepartmentControllerTest extends TestCase
{
    protected $tenancy = true;

    public function test_can_read_departments(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $department = Department::factory()->create();

        $response = $this->actingAs($user)->get('/api/hris/departments');

        $response
            ->assertExactJson([
                [
                    'id' => $department->id,
                    'parent_id' => $department->parent_id,
                    'name' => $department->name,
                    'description' => $department->description,
                    'created_at' => $department->created_at,
                    'updated_at' => $department->updated_at,
                ],
            ])
            ->assertJsonStructure([
                0 => [
                    'id',
                    'parent_id',
                    'name',
                    'description',
                    'created_at',
                    'updated_at',
                ],
            ])
            ->assertStatus(200);
    }

    public function test_can_read_a_department(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $department = Department::factory()->create();

        $response = $this->actingAs($user)->get("/api/hris/departments/{$department->id}");

        $response
            ->assertExactJson(
                [
                    'id' => $department->id,
                    'parent_id' => $department->parent_id,
                    'name' => $department->name,
                    'description' => $department->description,
                    'created_at' => $department->created_at,
                    'updated_at' => $department->updated_at,
            ]
            )
            ->assertJsonStructure(
                [
                    'id',
                    'parent_id',
                    'name',
                    'description',
                    'created_at',
                    'updated_at',
                ]
            )
            ->assertStatus(200);
    }

    public function test_can_create_a_department(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $department = Department::factory()->create();
        $faker = Factory::create();
        $data = [
            'parent_id' => $department->parent_id,
            'name' => $faker->name,
            'description' => $faker->sentence,
        ];

        $response = $this->actingAs($user)->post('/api/hris/departments', $data);
        $responseData = $response->getData();

        $response
            ->assertJsonStructure(
                [
                    'id',
                    'parent_id',
                    'name',
                    'description',
                    'created_at',
                    'updated_at',
                ]
            )
            ->assertStatus(201);
        $this->assertEquals($data['parent_id'], $responseData->parent_id);
        $this->assertEquals($data['name'], $responseData->name);
        $this->assertEquals($data['description'], $responseData->description);
    }

    public function test_can_update_a_department(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $department = Department::factory()->create();
        $faker = Factory::create();
        $data = [
            'parent_id' => 0,
            'name' => $faker->name,
            'description' => $faker->sentence,
        ];

        $response = $this->actingAs($user)->patch("/api/hris/departments/{$department->id}", $data);
        $responseData = $response->getData();

        $response
            ->assertJsonStructure(
                [
                    'id',
                    'parent_id',
                    'name',
                    'description',
                    'created_at',
                    'updated_at',
                ]
            )
            ->assertStatus(200);
        $this->assertEquals($data['parent_id'], $responseData->parent_id);
        $this->assertEquals($data['name'], $responseData->name);
        $this->assertEquals($data['description'], $responseData->description);
    }

    public function test_can_delete_a_department(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $department = Department::factory()->create();

        $response = $this->actingAs($user)->delete("/api/hris/departments/{$department->id}");
        $responseData = $response->getData();

        $response
            ->assertJsonStructure(
                [
                    'id',
                    'parent_id',
                    'name',
                    'description',
                    'created_at',
                    'updated_at',
                ]
            )
            ->assertStatus(200);
    }
}
