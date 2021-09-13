<?php

namespace App\Models;

use App\Http\Filter\QueryFilter;
use App\Models\Relations\User\BelongsToUser;
use Database\Factories\TransactionFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Transaction
 *
 * @property int $id
 * @property int $user_id Связь с пользователями
 * @property int $transaction_type_id Связь с типами транзакций
 * @property int $wallet_from_id Связь с кошельками
 * @property int|null $wallet_to_id Связь с кошельками
 * @property int|null $category_id Связь с категориями
 * @property string $amount Сумма транзакции
 * @property string $transacted_at Дата и время транзакции
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Category|null $category
 * @property-read TransactionType $transactionType
 * @property-read User $user
 * @property-read Wallet $walletFrom
 * @property-read Wallet|null $walletTo
 * @method static TransactionFactory factory(...$parameters)
 * @method static Builder|Transaction filter(QueryFilter $filters)
 * @method static Builder|Transaction newModelQuery()
 * @method static Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Query\Builder|Transaction onlyTrashed()
 * @method static Builder|Transaction query()
 * @method static \Illuminate\Database\Query\Builder|Transaction withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Transaction withoutTrashed()
 * @mixin Eloquent
 */
class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;
    use BelongsToUser;

    protected $guarded = [];

    public function walletFrom(): BelongsTo
    {
        return $this->belongsTo(Wallet::class, 'wallet_from_id');
    }

    public function walletTo(): BelongsTo
    {
        return $this->belongsTo(Wallet::class, 'wallet_to_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function transactionType(): BelongsTo
    {
        return $this->belongsTo(TransactionType::class);
    }

    public function scopeFilter(Builder $builder, QueryFilter $filters): Builder
    {
        return $filters->apply($builder);
    }
}
