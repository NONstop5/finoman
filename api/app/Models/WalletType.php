<?php

namespace App\Models;

use App\Models\Relations\Wallet\HasManyWallets;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\WalletType
 *
 * @property int $id
 * @property string $name Название типа кошелька
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Wallet[] $wallets
 * @property-read int|null $wallets_count
 * @method static Builder|WalletType newModelQuery()
 * @method static Builder|WalletType newQuery()
 * @method static Builder|WalletType query()
 * @mixin Eloquent
 */
class WalletType extends Model
{
    use HasFactory;
    use HasManyWallets;

    protected $guarded = [];
}
