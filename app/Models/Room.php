<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    protected $fillable = [
        'number',
        'capacity',
        'monthly_rent', 
        'status',
    ];    

    public function assignments(): HasMany
    {
        return $this->hasMany(Assignment::class, 'room_id');
    }

    public function utilityBills(): HasMany
    {
        return $this->hasMany(UtilityBill::class, 'room_id');
    }
}
