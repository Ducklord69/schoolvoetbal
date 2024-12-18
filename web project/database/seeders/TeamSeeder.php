<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    public function run()
    {
        $teams = ['Team A', 'Team B', 'Team C', 'Team D'];
        foreach ($teams as $teamName) {
            Team::create(['name' => $teamName]);
        }
    }
}
// Generate additional teams with random names
for ($i = 1; $i <= 100; $i++) {
    $teamName = 'Team ' . chr(65 + ($i % 26)) . $i;
    Team::create(['name' => $teamName]);
}
