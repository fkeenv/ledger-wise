<?php

namespace App\Models\Tenants\Accounting;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Requests\Tenants\Accounting\TransactionRequest;
use App\Http\Resources\Tenants\Accounting\TransactionResource;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['reference', 'description', 'date'];

    /* -------------------------------------------------------------------------- */
    /*                               Relationships                                */
    /* -------------------------------------------------------------------------- */

    public function splits(): HasMany
    {
        return $this->hasMany(TransactionSplit::class);
    }

    /* -------------------------------------------------------------------------- */
    /*                              Business Logic                                */
    /* -------------------------------------------------------------------------- */

    /**
     * Create a new transaction.
     */
    public static function createTransaction(TransactionRequest $request): TransactionResource
    {
        return DB::transaction(function () use ($request) {
            $transaction = Transaction::create([
                'reference'   => Str::uuid(),
                'description' => $request->input('description'),
                'date'        => $request->input('date'),
            ]);

            $splits = collect($request->input('splits'));

            $totalDebit = $splits->where('type', 'debit')->sum('amount');
            $totalCredit = $splits->where('type', 'credit')->sum('amount');

            if ($totalDebit !== $totalCredit) {
                throw new \Exception('Debit and credit amounts do not match.');
            }

            $splits->each(function ($split) use ($transaction) {
                $transaction->splits()->create([
                    'transaction_id' => $transaction->id,
                    'account_id' => $split['account_id'],
                    'amount'     => $split['amount'],
                    'type'       => $split['type'],
                ]);
            });

            return new TransactionResource($transaction);
        });
    }
}
