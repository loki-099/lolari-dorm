<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UtilityBill extends Model
{
    //
    protected $table = 'utility_bills';

    protected $fillable = [
        'room_id',
        'type',
        'amount',
        'billing_month',
        'due_date',
        'status',
    ];

    function room()
    {
        return $this->belongsTo(Room::class);
    }
    
    protected $casts = [
        'billing_month' => 'date',
        'due_date' => 'date',
    ];
}
