<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoarderActivity extends Model
{
    protected $table = 'boarder_activity';
    protected $fillable = [
        'boarder_id',
        'activity_name',
        'activity_date',
        'activity_reason',
    ];

    public function boarder()
    {
        return $this->belongsTo(Boarder::class, 'boarder_id');
    }
}
