<?php

namespace App\Models\Tenants\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionSplit extends Model
{
    use HasFactory;

    protected $fillable = ['account_id', 'transaction_id', 'amount', 'type'];

    /* -------------------------------------------------------------------------- */
    /*                               Relationships                                */
    /* -------------------------------------------------------------------------- */

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    /* -------------------------------------------------------------------------- */
    /*                              Mutators & Casts                              */
    /* -------------------------------------------------------------------------- */

    /**
     * Interact with the transaction's amount. Rule of thumb is we should use in centavos when saving in the database.
     */
    protected function amount(): Attribute
    {
        return Attribute::make(
            get: fn (int $value) => number_format($value / 100, 2),
            set: fn (float|int $value) => $value * 100,
        );
    }
}
