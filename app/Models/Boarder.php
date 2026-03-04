<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Boarder extends Model
{
    protected $fillable = ['name', 'contact', 'documents_path', 'status'];

    public function assignments(): HasMany
    {
        return $this->hasMany(Assignment::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
