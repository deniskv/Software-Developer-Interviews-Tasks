<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'team_id',
        'points',
        'played',
        'win',
        'lose',
        'draw',
        'goal_diff',
    ];

    public function team()
    {
        return $this->belongsTo(Teams::class);
    }
}
