<?php

namespace App\Models\Relations\Transaction;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Trait HasManyTransactions
 *
 * @property Transaction $transactions
 */
trait HasManyTransactions
{
    /**
     * @return HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
