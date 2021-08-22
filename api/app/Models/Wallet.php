<?php

namespace App\Models;

use App\Models\Relations\Transaction\HasManyTransactions;
use App\Models\Relations\User\BelongsToUser;
use Database\Factories\WalletFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\Wallet
 *
 * @property int $id
 * @property int $user_id Связь с пользователями
 * @property int $currency_id Связь с валютами
 * @property int $wallet_type_id Связь с типами кошельков
 * @property string $name Название кошелька
 * @mixin Eloquent
 * @property float $balance Начальный баланс кошелька
 * @property string $balance_date Дата начального баланса кошелька
 * @property string $icon Иконка кошелька
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Currency $currency
 * @property-read Collection|Transaction[] $transactions
 * @property-read int|null $transactions_count
 * @property-read User $user
 * @property-read WalletType $walletType
 * @method static WalletFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet newQuery()
 * @method static Builder|Wallet onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet query()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereBalanceDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereWalletTypeId($value)
 * @method static Builder|Wallet withTrashed()
 * @method static Builder|Wallet withoutTrashed()
 */
class Wallet extends Model
{
    use HasFactory;
    use SoftDeletes;
    use BelongsToUser;
    use HasManyTransactions;

    protected $guarded = [];

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function walletType(): BelongsTo
    {
        return $this->belongsTo(WalletType::class);
    }
}
