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
 * App\Models\Currency
 *
 * @property int $id
 * @property string $name Название валюты
 * @property string $code Код валюты
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Wallet[] $wallets
 * @property-read int|null $wallets_count
 * @method static Builder|Currency newModelQuery()
 * @method static Builder|Currency newQuery()
 * @method static Builder|Currency query()
 * @mixin Eloquent
 */
class Currency extends Model
{
    use HasFactory;
    use HasManyWallets;

    protected $guarded = [];
}
