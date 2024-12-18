<?php

namespace Database\Seeders;

use App\Models\Tournament;
use App\Models\User;
use Illuminate\Database\Seeder;

class TournamentSeeder extends Seeder
{
    public function run()
    {
        Tournament::create([
            'name' => 'Championship Tournament',
            'type' => 'single-elimination',
            'status' => 'not_started',
            'user_id' => User::first()->id,
        ]);
    }
}
