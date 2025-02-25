<?php

namespace Tests\Feature\Tenants\Accounting;

use Tests\TestCase;
use App\Models\Tenants\User;
use App\Models\Tenants\Accounting\Account;

class AccountControllerTest extends TestCase
{
    protected $tenancy = true;

    public function test_can_read_accounts(): void
    {
        $user = User::factory()->create();
        Account::factory(2)->create();

        /** @var User $user */
        $response = $this->actingAs($user)->get('/api/accg/accounts');

        $response
            ->assertJsonStructure([
                0 => [
                    'id',
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

    public function test_can_read_an_account(): void
    {
        $user = User::factory()->create();
        $account = Account::factory()->create();

        /** @var User $user */
        $response = $this->actingAs($user)->get("/api/accg/accounts/{$account->id}");

        $response->assertJsonStructure([
            'id',
            'parent_id',
            'name',
            'description',
            '_lft',
            '_rgt',
            'created_at',
            'updated_at',
        ])
            ->assertStatus(200);
    }

    public function test_can_create_an_account(): void
    {
        $user = User::factory()->create();
        $data = [
            'code' => '1000',
            'name' => 'Cash',
            'description' => 'Cash account',
            'is_hidden' => false,
        ];

        /** @var User $user */
        $response = $this->actingAs($user)->post('/api/accg/accounts/', $data);

        $response->assertJsonStructure([
            'id',
            'parent_id',
            'name',
            'description',
            '_lft',
            '_rgt',
            'created_at',
            'updated_at',
        ])
            ->assertStatus(201);
    }

    public function test_can_update_an_account(): void
    {
        $user = User::factory()->create();
        $account = Account::factory()->create();
        $data = [
            'code' => '1000',
            'name' => 'Cash',
            'description' => 'Cash account',
            'is_hidden' => false,
        ];

        /** @var User $user */
        $response = $this->actingAs($user)->patch("/api/accg/accounts/{$account->id}", $data);
        $responseData = $response->getData();

        $response->assertJsonStructure([
            'id',
            'parent_id',
            'name',
            'description',
            '_lft',
            '_rgt',
            'created_at',
            'updated_at',
        ])
            ->assertStatus(200);

        $this->assertEquals($data['code'], $responseData->code);
        $this->assertEquals($data['name'], $responseData->name);
        $this->assertEquals($data['description'], $responseData->description);
        $this->assertEquals($data['is_hidden'], $responseData->is_hidden);
    }

    public function test_can_delete_an_account(): void
    {
        $user = User::factory()->create();
        $account = Account::factory()->create();

        /** @var User $user */
        $response = $this->actingAs($user)->delete("/api/accg/accounts/{$account->id}");

        $response->assertJsonStructure([
            'id',
            'parent_id',
            'name',
            'description',
            '_lft',
            '_rgt',
            'created_at',
            'updated_at',
        ])
            ->assertStatus(200);
    }
}
