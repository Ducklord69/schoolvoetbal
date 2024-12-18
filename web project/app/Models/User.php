<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasRole(string $roleName): bool
    {
        return $this->role === $roleName;
    }
    public function tournaments()
    {
        return $this->hasMany(Tournament::class);
    }
    public function team()
    {
        return $this->hasOne(Team::class);
    }
}
