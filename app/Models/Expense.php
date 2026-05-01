<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    protected $fillable = [
        'room_id',
        'staff_id', 
        'expense_type',
        'description', 
        'amount',
        'expense_date'
    ];
    
    protected $casts = [
        'amount' => 'decimal:2',
        'expense_date' => 'date',
    ];
    
    /**
     * Get the room that owns the expense.
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
    
    /**
     * Get the staff member who created the expense.
     */
    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }
}
