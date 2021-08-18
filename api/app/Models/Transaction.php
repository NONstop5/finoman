<?php

namespace App\Models;

use App\Http\Filter\QueryFilter;
use App\Models\Relations\User\BelongsToUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @package App\Models
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
