<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Specify the table name if it's not the plural form of the model
    protected $table = 'roles';

    // Define the fields that can be mass-assigned
    protected $fillable = ['name'];

    // Define the relationship between roles and users
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
