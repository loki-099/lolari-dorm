<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    //
    protected $fillable = [
        'user_id',
        'employment_date',
        'status',
    ];
    
    protected $table = 'staffs';

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
