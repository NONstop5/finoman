<?php

namespace App\Models;

use App\Models\Relations\User\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;
    use BelongsToUser;

    protected $guarded = [];

    public function categoryType(): BelongsTo
    {
        return $this->belongsTo(CategoryType::class);
    }
}
