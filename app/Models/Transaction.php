<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function accountFrom(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_from_id');
    }

    public function accountTo(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_to_id');
    }
}
