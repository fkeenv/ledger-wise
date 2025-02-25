<?php

namespace Tests\Feature\Tenants\Accounting;

use Tests\TestCase;
use App\Models\Tenants\User;
use App\Models\Tenants\Accounting\Customer;

class CustomerControllerTest extends TestCase
{
    protected $tenancy = true;

    public function test_can_read_customers(): void
    {
        $user = User::factory()->create();
        Customer::factory(2)->create();

        /** @var User $user */
        $response = $this->actingAs($user)->get('/api/accg/customers');

        $response
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'first_name',
                        'middle_name',
                        'last_name',
                        'email',
                        'mobile',
                        'notes',
                        'is_active',
                        'is_taxable',
                    ],
                ],
            ])
            ->assertStatus(200);
    }

    public function test_can_create_a_customer(): void
    {
        $user = User::factory()->create();

        $data = Customer::factory()->make()->toArray();

        /** @var User $user */
        $response = $this->actingAs($user)->post('/api/accg/customers', $data);

        $response
            ->assertJson($data)
            ->assertStatus(201);
    }

    public function test_can_read_a_customer(): void
    {
        $user = User::factory()->create();
        $customer = Customer::factory()->create();

        /** @var User $user */
        $response = $this->actingAs($user)->get("/api/accg/customers/{$customer->id}");

        $response
            ->assertJson($customer->toArray())
            ->assertStatus(200);
    }

    public function test_can_update_a_customer(): void
    {
        $user = User::factory()->create();
        $customer = Customer::factory()->create();

        $data = Customer::factory()->make()->toArray();

        /** @var User $user */
        $response = $this->actingAs($user)->put("/api/accg/customers/{$customer->id}", $data);

        $response
            ->assertJson($data)
            ->assertStatus(200);
    }

    public function test_can_delete_a_customer(): void
    {
        $user = User::factory()->create();
        $customer = Customer::factory()->create();

        /** @var User $user */
        $response = $this->actingAs($user)->delete("/api/accg/customers/{$customer->id}");

        $response
            ->assertJson($customer->toArray())
            ->assertStatus(200);
    }
}
