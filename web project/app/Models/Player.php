<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = ['name', 'team_id'];

    // Define the relationship with the Team model
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
