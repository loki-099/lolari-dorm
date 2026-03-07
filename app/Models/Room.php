<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    protected $fillable = ['number', 'type', 'price', 'status'];

    public function assignments(): HasMany
    {
        return $this->hasMany(Assignment::class);
    }
}
