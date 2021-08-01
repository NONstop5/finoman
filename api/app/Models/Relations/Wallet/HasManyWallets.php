<?php

namespace App\Models\Relations\Wallet;

use App\Models\Wallet;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Trait HasManyWallets
 *
 * @property Wallet $wallets
 */
trait HasManyWallets
{
    /**
     * @return HasMany
     */
    public function wallets(): HasMany
    {
        return $this->hasMany(Wallet::class);
    }
}
