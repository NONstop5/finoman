<?php

namespace App\Models;

use App\Models\Relations\Transaction\HasManyTransactions;
use App\Models\Relations\User\BelongsToUser;
use Database\Factories\CategoryFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property int $user_id Связь с пользователями
 * @property int $category_type_id Связь с типами категорий
 * @property string $name Название категории
 * @property float $budget Бюджет категории
 * @property string $icon Иконка категории
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read CategoryType $categoryType
 * @property-read Collection|Transaction[] $transactions
 * @property-read int|null $transactions_count
 * @property-read User $user
 * @method static CategoryFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static Builder|Category onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereBudget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCategoryTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUserId($value)
 * @method static Builder|Category withTrashed()
 * @method static Builder|Category withoutTrashed()
 * @mixin Eloquent
 */
class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    use BelongsToUser;
    use HasManyTransactions;

    protected $guarded = [];

    public function categoryType(): BelongsTo
    {
        return $this->belongsTo(CategoryType::class);
    }
}
