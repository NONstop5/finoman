<?php

namespace App\Models;

use App\Models\Relations\Wallet\HasManyWallets;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    use HasManyWallets;

    protected $guarded = [];
}
