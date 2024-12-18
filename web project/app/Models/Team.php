<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Team extends Model
{
    protected $fillable = ['name', 'user_id', 'description']; // Add 'description' to fillable array

    // Existing relationships remain the same
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function tournaments()
    {
        return $this->belongsToMany(Tournament::class, 'tournament_team');
    }
}
