<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = ['boarder_id', 'amount', 'payment_method', 'status', 'staff_id'];

    public function boarder(): BelongsTo
    {
        return $this->belongsTo(Boarder::class);
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(User::class, 'staff_id');
    }
}
