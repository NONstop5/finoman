<?php

namespace App\Models;

use App\Models\Relations\User\HasManyCategories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryType extends Model
{
    use HasFactory;
    use HasManyCategories;

    protected $guarded = [];
}
