<?php

namespace App\Models;

use App\Models\Relations\Category\HasManyCategories;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\CategoryType
 *
 * @property int $id
 * @property string $name Название типа категории
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Category[] $categories
 * @property-read int|null $categories_count
 * @method static Builder|CategoryType newModelQuery()
 * @method static Builder|CategoryType newQuery()
 * @method static Builder|CategoryType query()
 * @mixin Eloquent
 */
class CategoryType extends Model
{
    use HasFactory;
    use HasManyCategories;

    protected $guarded = [];
}
