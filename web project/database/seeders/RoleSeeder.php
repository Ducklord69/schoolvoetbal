<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => 'normal user']);
        Role::create(['name' => 'coach']);
        Role::create(['name' => 'admin']);
    }
}

