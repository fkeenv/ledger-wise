<?php

namespace Tests\Feature\Tenants;

use Faker\Factory;
use Tests\TestCase;
use App\Models\Tenants\User;
use App\Models\Tenants\Employee;

class EmployeeControllerTest extends TestCase
{
    protected $tenancy = true;

    public function test_can_read_employees(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $employee = Employee::factory()->create();

        $response = $this->actingAs($user)->get('/api/hris/employees');

        $response
            ->assertExactJson([
                [
                    'id'            => $employee->id,
                    'first_name'    => $employee->first_name,
                    'middle_name'   => $employee->middle_name,
                    'last_name'     => $employee->last_name,
                    'gender'        => $employee->gender,
                    'mobile_number' => $employee->mobile_number,
                    'birth_date'    => $employee->birth_date,
                    'created_at'    => $employee->created_at,
                    'updated_at'    => $employee->updated_at,
                ],
            ])
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
                ],
            ])
            ->assertStatus(200);
    }

    public function test_can_read_an_employee(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $employee = Employee::factory()->create();

        $response = $this->actingAs($user)->get("/api/hris/employees/{$employee->id}");

        $response
            ->assertExactJson(
                [
                    'id' => $employee->id,
                    'first_name' => $employee->first_name,
                    'middle_name' => $employee->middle_name,
                    'last_name' => $employee->last_name,
                    'gender' => $employee->gender,
                    'mobile_number' => $employee->mobile_number,
                    'birth_date' => $employee->birth_date,
                    'created_at' => $employee->created_at,
                    'updated_at' => $employee->updated_at,
                ]
            )
            ->assertJsonStructure(
                [
                    'id',
                    'first_name',
                    'middle_name',
                    'last_name',
                    'gender',
                    'mobile_number',
                    'birth_date',
                    'created_at',
                    'updated_at',
                ]
            )
            ->assertStatus(200);
    }

    public function test_can_create_an_employee(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $employee = Employee::factory()->create();
        $faker = Factory::create();
        $data = [
            'first_name'    => $faker->firstName('female'),
            'middle_name'   => $faker->lastName,
            'last_name'     => $faker->lastName,
            'gender'        => 'female',
            'mobile_number' => $faker->phoneNumber,
            'birth_date'    => $faker->date,
        ];

        $response = $this->actingAs($user)->post('/api/hris/employees', $data);
        $responseData = $response->getData();

        $response
            ->assertJsonStructure(
                [
                    'id',
                    'first_name',
                    'middle_name',
                    'last_name',
                    'gender',
                    'mobile_number',
                    'birth_date',
                    'created_at',
                    'updated_at',
                ]
            )
            ->assertStatus(201);
        $this->assertEquals($data['first_name'], $responseData->first_name);
        $this->assertEquals($data['middle_name'], $responseData->middle_name);
        $this->assertEquals($data['last_name'], $responseData->last_name);
        $this->assertEquals($data['gender'], $responseData->gender);
        $this->assertEquals($data['mobile_number'], $responseData->mobile_number);
        $this->assertEquals($data['birth_date'], $responseData->birth_date);
    }

    public function test_can_update_an_employee(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $employee = Employee::factory()->create();
        $faker = Factory::create();
        $data = [
            'first_name'    => $faker->firstName('female'),
            'middle_name'   => $faker->lastName,
            'last_name'     => $faker->lastName,
            'gender'        => 'female',
            'mobile_number' => $faker->phoneNumber,
            'birth_date'    => $faker->date,
        ];

        $response = $this->actingAs($user)->patch("/api/hris/employees/{$employee->id}", $data);
        $responseData = $response->getData();

        $response
            ->assertJsonStructure(
                [
                    'id',
                    'first_name',
                    'middle_name',
                    'last_name',
                    'gender',
                    'mobile_number',
                    'birth_date',
                    'created_at',
                    'updated_at',
                ]
            )
            ->assertStatus(200);
        $this->assertEquals($data['first_name'], $responseData->first_name);
        $this->assertEquals($data['middle_name'], $responseData->middle_name);
        $this->assertEquals($data['last_name'], $responseData->last_name);
        $this->assertEquals($data['gender'], $responseData->gender);
        $this->assertEquals($data['mobile_number'], $responseData->mobile_number);
        $this->assertEquals($data['birth_date'], $responseData->birth_date);
    }

    public function test_can_delete_an_employee(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $employee = Employee::factory()->create();

        $response = $this->actingAs($user)->delete("/api/hris/employees/{$employee->id}");
        $responseData = $response->getData();

        $response
            ->assertJsonStructure(
                [
                    'id',
                    'first_name',
                    'middle_name',
                    'last_name',
                    'gender',
                    'mobile_number',
                    'birth_date',
                    'created_at',
                    'updated_at',
                ]
            )
            ->assertStatus(200);
    }
}
