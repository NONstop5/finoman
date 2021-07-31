<?php

namespace App\Models\Relations\User;

use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Trait HasManyCategories
 *
 * @property Category $categories
 */
trait HasManyCategories
{
    /**
     * @return HasMany
     */
    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }
}
