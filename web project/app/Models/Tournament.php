<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Matches;


class Tournament extends Model
{
    protected $fillable = ['name', 'type', 'status', 'user_id', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'tournament_team');
    }

    public function matches()
    {
        return $this->hasMany(Matches::class);
    }
}

