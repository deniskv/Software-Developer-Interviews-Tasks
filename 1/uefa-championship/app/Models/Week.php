<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $casts = [
        'played' => 'boolean',
    ];

    public function matches()
    {
        return $this->hasMany('App\Models\Matches');
    }

    public function scopePlayed($query)
    {
        return $query->where('played', 1);
    }

    public function scopeNotPlayed($query)
    {
        return $query->where('played', 0);
    }

    public function scopeSetPlayed($query)
    {
        return $query->update(['played' => 1]);
    }

}
