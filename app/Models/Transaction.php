<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = ['boarder_id', 'room_id', 'staff_id', 'amount', 'payment_method', 'status', 'billing_month', 'type'];

    public function boarder(): BelongsTo
    {
        return $this->belongsTo(Boarder::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }
}
