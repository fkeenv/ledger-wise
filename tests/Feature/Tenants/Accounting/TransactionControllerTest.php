<?php

namespace Tests\Feature\Tenants\Accounting;

use Faker\Factory;
use Tests\TestCase;
use App\Models\Tenants\User;
use App\Models\Tenants\Accounting\Account;
use App\Models\Tenants\Accounting\Transaction;
use App\Models\Tenants\Accounting\TransactionSplit;
use Illuminate\Database\Eloquent\Factories\Sequence;

class TransactionControllerTest extends TestCase
{
    protected $tenancy = true;

    public function test_can_read_transactions(): void
    {
        $user = User::factory()->create();
        $account = Account::factory()->create();
        $transaction = Transaction::factory()->create();
        $amount = random_int(0, 10000);
        TransactionSplit::factory(2)->create(new Sequence(
            [
                'account_id' => $account->id,
                'transaction_id' => $transaction->id,
                'amount' => $amount,
                'type' => 'debit',
            ],
            [
                'account_id' => $account->id,
                'transaction_id' => $transaction->id,
                'amount' => $amount,
                'type' => 'credit',
            ],
        ));
        /** @var User $user */
        $response = $this->actingAs($user)->get('/api/accg/transactions');

        $response
            ->assertJsonStructure([
                'data' => [
                    0 => [
                        'id',
                        'reference',
                        'description',
                        'date',
                        'created_at',
                        'updated_at',
                        'splits' => [
                            0 => [
                                'id',
                                'account_id',
                                'amount',
                                'type',
                                'created_at',
                                'updated_at',
                            ],
                            1 => [
                                'id',
                                'account_id',
                                'amount',
                                'type',
                                'created_at',
                                'updated_at',
                            ],
                        ],
                    ],
                ],
            ])
            ->assertStatus(200);
    }

    public function test_can_read_a_transaction(): void
    {
        $user = User::factory()->create();
        $account = Account::factory()->create();
        $transaction = Transaction::factory()->create();
        $amount = random_int(0, 10000);
        TransactionSplit::factory(2)->create(new Sequence(
            [
                'account_id' => $account->id,
                'transaction_id' => $transaction->id,
                'amount' => $amount,
                'type' => 'debit',
            ],
            [
                'account_id' => $account->id,
                'transaction_id' => $transaction->id,
                'amount' => $amount,
                'type' => 'credit',
            ],
        ));
        /** @var User $user */
        $response = $this->actingAs($user)->get("/api/accg/transactions/{$transaction->id}");

        $response
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'reference',
                    'description',
                    'date',
                    'created_at',
                    'updated_at',
                    'splits' => [
                        0 => [
                            'id',
                            'account_id',
                            'amount',
                            'type',
                            'created_at',
                            'updated_at',
                        ],
                        1 => [
                            'id',
                            'account_id',
                            'amount',
                            'type',
                            'created_at',
                            'updated_at',
                        ],
                    ],
                ],
            ])
            ->assertStatus(200);
    }

    public function test_can_create_a_transaction(): void
    {
        $user = User::factory()->create();
        $account = Account::factory()->create();
        $faker = Factory::create();

        $amount = random_int(0, 10000);
        $data = [
            'description' => $faker->text(),
            'date' => $faker->date(),
            'splits' => [
                [
                    'account_id' => $account->id,
                    'amount' => $amount,
                    'type' => 'credit',
                ],
                [
                    'account_id' => $account->id,
                    'amount' => $amount,
                    'type' => 'debit',
                ],
            ],
        ];

        /** @var User $user */
        $response = $this->actingAs($user)->post('/api/accg/transactions', $data);

        $response
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'reference',
                    'description',
                    'date',
                    'created_at',
                    'updated_at',
                    'splits' => [
                        0 => [
                            'id',
                            'account_id',
                            'amount',
                            'type',
                            'created_at',
                            'updated_at',
                        ],
                        1 => [
                            'id',
                            'account_id',
                            'amount',
                            'type',
                            'created_at',
                            'updated_at',
                        ],
                    ],
                ],
            ])
            ->assertStatus(201);
    }

    public function test_can_update_a_transaction(): void
    {
        $user = User::factory()->create();
        $account = Account::factory()->create();
        $transaction = Transaction::factory()->create();
        $amount = random_int(0, 10000);
        TransactionSplit::factory(2)->create(new Sequence(
            [
                'account_id' => $account->id,
                'transaction_id' => $transaction->id,
                'amount' => $amount,
                'type' => 'debit',
            ],
            [
                'account_id' => $account->id,
                'transaction_id' => $transaction->id,
                'amount' => $amount,
                'type' => 'credit',
            ],
        ));

        $data = [
            'description' => 'Updated description',
            'date' => '2021-01-01',
        ];

        /** @var User $user */
        $response = $this->actingAs($user)->patch("/api/accg/transactions/{$transaction->id}", $data);

        $response
            ->assertJsonStructure([
                'id',
                'reference',
                'description',
                'date',
                'created_at',
                'updated_at',
            ])
            ->assertStatus(200);
    }
}
