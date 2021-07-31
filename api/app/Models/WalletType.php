<?php

namespace App\Models;

use App\Models\Relations\User\HasManyWallets;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletType extends Model
{
    use HasFactory;
    use HasManyWallets;

    protected $guarded = [];
}
