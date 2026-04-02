<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Boarder extends Model
{
    protected $fillable = ['user_id', 'home_address', 'parent_contact', 'status'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function assignments(): HasMany
    {
        return $this->hasMany(Assignment::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function activities(): HasMany
    {
        return $this->hasMany(BoarderActivity::class);
    }
}
