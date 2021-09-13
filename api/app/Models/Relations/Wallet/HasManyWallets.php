<?php

namespace App\Models\Relations\Wallet;

use App\Models\Wallet;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManyWallets
{
    public function wallets(): HasMany
    {
        return $this->hasMany(Wallet::class);
    }
}
