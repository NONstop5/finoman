<?php

namespace App\Models;

use App\Models\Relations\Transaction\HasManyTransactions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    use HasFactory;
    use HasManyTransactions;

    protected $guarded = [];
}
