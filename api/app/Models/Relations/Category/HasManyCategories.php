<?php

namespace App\Models\Relations\Category;

use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManyCategories
{
    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }
}
