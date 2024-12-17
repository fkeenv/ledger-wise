<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Tenants\User;
use App\Models\Tenants\Accounting\Customer;

class AddressControllerTest extends TestCase
{
    protected $tenancy = true;

    public function test_can_read_addresses(): void
    {
        $user = User::factory()->create();
        $customer = Customer::factory()->create();
        $customer->addresses()->create([
            'address1' => '123 Main St',
            'city' => 'Anytown',
            'state' => 'NY',
            'zip' => '12345',
            'country' => 'US',
            'type' => 'billing',
        ]);

        /** @var User $user */
        $response = $this->actingAs($user)->get("/api/common/customers/{$customer->id}/addresses");

        $response
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'address1',
                    'address2',
                    'city',
                    'state',
                    'zip',
                    'country',
                    'type',
                ],
            ])
            ->assertStatus(200);
    }

    public function test_can_create_an_address(): void
    {
        $user = User::factory()->create();
        $customer = Customer::factory()->create();

        $data = [
            'address1' => '123 Main St',
            'city' => 'Anytown',
            'state' => 'NY',
            'zip' => '12345',
            'country' => 'US',
            'type' => 'billing',
        ];

        /** @var User $user */
        $response = $this->actingAs($user)->post("/api/common/customers/{$customer->id}/addresses", $data);

        $response
            ->assertJson($data)
            ->assertStatus(201);
    }

    public function test_can_read_an_address(): void
    {
        $user = User::factory()->create();
        $customer = Customer::factory()->create();
        $address = $customer->addresses()->create([
            'address1' => '123 Main St',
            'city' => 'Anytown',
            'state' => 'NY',
            'zip' => '12345',
            'country' => 'US',
            'type' => 'billing',
        ]);

        /** @var User $user */
        $response = $this->actingAs($user)->get("/api/common/customers/{$customer->id}/addresses/{$address->id}");

        $response
            ->assertJson($address->toArray())
            ->assertStatus(200);
    }

    public function test_can_update_an_address(): void
    {
        $user = User::factory()->create();
        $customer = Customer::factory()->create();
        $address = $customer->addresses()->create([
            'address1' => '123 Main St',
            'city' => 'Anytown',
            'state' => 'NY',
            'zip' => '12345',
            'country' => 'US',
            'type' => 'billing',
        ]);

        $data = [
            'address1' => '456 Elm St',
            'city' => 'Othertown',
            'state' => 'CA',
            'zip' => '54321',
            'country' => 'US',
            'type' => 'shipping',
        ];

        /** @var User $user */
        $response = $this->actingAs($user)->put("/api/common/customers/{$customer->id}/addresses/{$address->id}", $data);

        $response
            ->assertJson($data)
            ->assertStatus(200);
    }

    public function test_can_delete_an_address(): void
    {
        $user = User::factory()->create();
        $customer = Customer::factory()->create();
        $address = $customer->addresses()->create([
            'address1' => '123 Main St',
            'city' => 'Anytown',
            'state' => 'NY',
            'zip' => '12345',
            'country' => 'US',
            'type' => 'billing',
        ]);

        /** @var User $user */
        $response = $this->actingAs($user)->delete("/api/common/customers/{$customer->id}/addresses/{$address->id}");

        $response
            ->assertJson($address->toArray())
            ->assertStatus(200);
    }
}
