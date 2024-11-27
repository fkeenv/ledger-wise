<?php

namespace Tests\Feature\Tenants\HRIS;

use Tests\TestCase;
use App\Models\Tenants\User;
use App\Models\Tenants\Accounting\Account;

class SubAccountControllerTest extends TestCase
{
    protected $tenancy = true;

    public function test_can_read_sub_accounts(): void
    {
        $user = User::factory()->create();
        $account = Account::factory()->create();
        $account->children()->create([
            'code' => '10001',
            'name' => 'Cash',
            'description' => 'Cash account',
            'is_hidden' => false,
        ]);

        /** @var User $user */
        $response = $this->actingAs($user)->get("/api/accg/accounts/{$account->id}/sub-accounts");

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

    public function test_can_read_a_sub_account(): void
    {
        $user = User::factory()->create();
        $account = Account::factory()->create();
        $subAccount = $account->children()->create([
            'code' => '1000',
            'name' => 'Cash',
            'description' => 'Cash account',
            'is_hidden' => false,
        ]);

        /** @var User $user */
        $response = $this->actingAs($user)->get("/api/accg/accounts/{$account->id}/sub-accounts/{$subAccount->id}");

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

    public function test_can_create_a_sub_account(): void
    {
        $user = User::factory()->create();
        $account = Account::factory()->create();
        $data = [
            'code' => '10002',
            'name' => 'Bank',
            'description' => 'Bank account',
            'is_hidden' => false,
        ];

        /** @var User $user */
        $response = $this->actingAs($user)->post("/api/accg/accounts/{$account->id}/sub-accounts", $data);
        $responseData = $response->getData();

        $response->assertJsonStructure([
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

        $this->assertEquals($data['code'], $responseData[0]->code);
        $this->assertEquals($data['name'], $responseData[0]->name);
        $this->assertEquals($data['description'], $responseData[0]->description);
        $this->assertEquals($data['is_hidden'], $responseData[0]->is_hidden);
    }

    public function test_can_update_a_sub_account(): void
    {
        $user = User::factory()->create();
        $account = Account::factory()->create();
        $subAccount = $account->children()->create([
            'code' => '10001',
            'name' => 'Cash',
            'description' => 'Cash account',
            'is_hidden' => false,
        ]);
        $data = [
            'code' => '10002',
            'name' => 'Bank',
            'description' => 'Bank account',
            'is_hidden' => false,
        ];

        /** @var User $user */
        $response = $this->actingAs($user)->patch("/api/accg/accounts/{$account->id}/sub-accounts/{$subAccount->id}", $data);
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

    public function test_can_delete_a_sub_account(): void
    {
        $user = User::factory()->create();
        $account = Account::factory()->create();
        $subAccount = $account->children()->create([
            'code' => '10001',
            'name' => 'Cash',
            'description' => 'Cash account',
            'is_hidden' => false,
        ]);

        /** @var User $user */
        $response = $this->actingAs($user)->delete("/api/accg/accounts/{$account->id}/sub-accounts/{$subAccount->id}");

        $response->assertJsonStructure([])
            ->assertStatus(200);
    }
}
