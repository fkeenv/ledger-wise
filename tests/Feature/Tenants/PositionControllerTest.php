<?php

namespace Tests\Feature\Tenants;

use Faker\Factory;
use Tests\TestCase;
use App\Models\Tenants\User;
use App\Models\Tenants\HRIS\Position;
use App\Models\Tenants\HRIS\Department;

class PositionControllerTest extends TestCase
{
    protected $tenancy = true;

    public function test_can_read_positions(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $department = Department::factory()->create();
        $position = Position::factory()->create([
            'department_id' => $department->id,
        ]);
        $response = $this->actingAs($user)->get('/api/hris/positions');

        $response
            ->assertExactJson([
                [
                    'id'            => $position->id,
                    'department_id' => $position->department_id,
                    'parent_id'     => $position->parent_id,
                    'name'          => $position->name,
                    'description'   => $position->description,
                    '_lft'          => $position->_lft,
                    '_rgt'          => $position->_rgt,
                    'created_at' => $position->created_at,
                    'updated_at' => $position->updated_at,
                ],
            ])
            ->assertJsonStructure([
                0 => [
                    'id',
                    'department_id',
                    'parent_id',
                    'name',
                    'description',
                    '_lft',
                    '_rgt',
                    'created_at',
                    'updated_at',
                ],
            ])
            ->assertStatus(200);
    }

    public function test_can_read_a_position(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $department = Department::factory()->create();
        $position = Position::factory()->create([
            'department_id' => $department->id,
        ]);
        $response = $this->actingAs($user)->get("/api/hris/positions/{$position->id}");

        $response
            ->assertExactJson(
                [
                    'id' => $position->id,
                    'department_id' => $position->department_id,
                    'parent_id' => $position->parent_id,
                    'name' => $position->name,
                    'description' => $position->description,
                    '_lft' => $position->_lft,
                    '_rgt' => $position->_rgt,
                    'created_at' => $position->created_at,
                    'updated_at' => $position->updated_at,
                ]
            )
            ->assertJsonStructure(
                [
                    'id',
                    'department_id',
                    'parent_id',
                    'name',
                    'description',
                    '_lft',
                    '_rgt',
                    'created_at',
                    'updated_at',
                ]
            )
            ->assertStatus(200);
    }

    public function test_can_create_a_position(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $department = Department::factory()->create();
        $faker = Factory::create();
        $data = [
            'department_id' => $department->id,
            'name' => $faker->name,
            'description' => $faker->sentence,
        ];

        $response = $this->actingAs($user)->post('/api/hris/positions', $data);
        $responseData = $response->getData();

        $response
            ->assertJsonStructure(
                [
                    'id',
                    'department_id',
                    'name',
                    'description',
                    'created_at',
                    'updated_at',
                ]
            )
            ->assertStatus(201);
        $this->assertEquals($data['department_id'], $responseData->department_id);
        $this->assertEquals($data['name'], $responseData->name);
        $this->assertEquals($data['description'], $responseData->description);
    }

    public function test_can_update_a_position(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $department = Department::factory()->create();
        $position = Position::factory()->create([
            'department_id' => $department->id,
        ]);
        $faker = Factory::create();
        $data = [
            'department_id' => $department->id,
            'name' => $faker->name,
            'description' => $faker->sentence,
        ];

        $response = $this->actingAs($user)->patch("/api/hris/positions/{$position->id}", $data);
        $responseData = $response->getData();

        $response
            ->assertJsonStructure(
                [
                    'id',
                    'department_id',
                    'parent_id',
                    'name',
                    'description',
                    '_lft',
                    '_rgt',
                    'created_at',
                    'updated_at',
                ]
            )
            ->assertStatus(200);
        $this->assertEquals($data['department_id'], $responseData->department_id);
        $this->assertEquals($data['name'], $responseData->name);
        $this->assertEquals($data['description'], $responseData->description);
    }

    public function test_can_delete_a_position(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $department = Department::factory()->create();
        $position = Position::factory()->create([
            'department_id' => $department->id,
        ]);
        $response = $this->actingAs($user)->delete("/api/hris/positions/{$position->id}");

        $response
            ->assertJsonStructure(
                [
                    'id',
                    'department_id',
                    'parent_id',
                    'name',
                    'description',
                    '_lft',
                    '_rgt',
                    'created_at',
                    'updated_at',
                ]
            )
            ->assertStatus(200);
    }
}
