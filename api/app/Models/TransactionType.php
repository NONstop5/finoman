<?php

namespace App\Models;

use App\Models\Relations\Transaction\HasManyTransactions;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\TransactionType
 *
 * @property int $id
 * @property string $name Название типа транзакции
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Transaction[] $transactions
 * @property-read int|null $transactions_count
 * @method static Builder|TransactionType newModelQuery()
 * @method static Builder|TransactionType newQuery()
 * @method static Builder|TransactionType query()
 * @method static Builder|TransactionType whereCreatedAt($value)
 * @method static Builder|TransactionType whereId($value)
 * @method static Builder|TransactionType whereName($value)
 * @method static Builder|TransactionType whereUpdatedAt($value)
 * @mixin Eloquent
 */
class TransactionType extends Model
{
    use HasFactory;
    use HasManyTransactions;

    protected $guarded = [];
}
