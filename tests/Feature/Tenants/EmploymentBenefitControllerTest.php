<?php

namespace Tests\Feature\Tenants;

use Tests\TestCase;
use App\Models\Tenants\User;
use App\Models\Tenants\HRIS\EmploymentBenefit;

class EmploymentBenefitControllerTest extends TestCase
{
    protected $tenancy = true;

    public function test_can_read_employment_benefits(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        EmploymentBenefit::factory(2)->create();

        $response = $this->actingAs($user)->get('/api/hris/employment-benefits');

        $response
            ->assertJsonStructure([
                0 => [
                    'id',
                    'name',
                    'description',
                    'sector',
                    'type',
                ],
            ])
            ->assertStatus(200);
    }

    public function test_can_read_an_employment_benefit(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $employmentBenefit = EmploymentBenefit::factory()->create();

        $response = $this->actingAs($user)->get("/api/hris/employment-benefits/{$employmentBenefit->id}");

        $response
            ->assertJsonStructure([
                'id',
                'name',
                'description',
                'sector',
                'type',
            ])
            ->assertStatus(200);
    }

    public function test_can_create_an_employment_benefit(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $data = [
            'name' => 'Health Insurance',
            'description' => 'Health insurance for employees',
            'sector' => 'private',
            'type' => 'mandatory',
        ];

        $response = $this->actingAs($user)->post('/api/hris/employment-benefits', $data);
        $responseData = $response->getData();

        $response
            ->assertJsonStructure([
                'id',
                'name',
                'description',
                'sector',
                'type',
            ])
            ->assertStatus(201);

        $this->assertEquals($data['name'], $responseData->name);
        $this->assertEquals($data['description'], $responseData->description);
        $this->assertEquals($data['sector'], $responseData->sector);
        $this->assertEquals($data['type'], $responseData->type);
    }

    public function test_can_update_an_employment_benefit(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $employmentBenefit = EmploymentBenefit::factory()->create();
        $data = [
            'name' => 'Health Insurance',
            'description' => 'Health insurance for employees',
            'sector' => 'private',
            'type' => 'mandatory',
        ];

        $response = $this->actingAs($user)->patch("/api/hris/employment-benefits/{$employmentBenefit->id}", $data);
        $responseData = $response->getData();

        $response
            ->assertJsonStructure([
                'id',
                'name',
                'description',
                'sector',
                'type',
            ])
            ->assertStatus(200);

        $this->assertEquals($data['name'], $responseData->name);
        $this->assertEquals($data['description'], $responseData->description);
        $this->assertEquals($data['sector'], $responseData->sector);
        $this->assertEquals($data['type'], $responseData->type);
    }

    public function test_can_delete_an_employment_benefit(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $employmentBenefit = EmploymentBenefit::factory()->create();

        $response = $this->actingAs($user)->delete("/api/hris/employment-benefits/{$employmentBenefit->id}");
        $responseData = $response->getData();

        $response
            ->assertJsonStructure([
                'id',
                'name',
                'description',
                'sector',
                'type',
            ])
            ->assertStatus(200);

        $this->assertDatabaseMissing('employment_benefits', [
            'id' => $employmentBenefit->id,
        ]);
    }
}
