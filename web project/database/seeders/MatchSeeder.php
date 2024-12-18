<?php

namespace Database\Seeders;

use App\Models\Matches;
use App\Models\Tournament;
use App\Models\Team;
use Illuminate\Database\Seeder;

class MatchSeeder extends Seeder
{
    public function run()
    {
        $tournament = Tournament::first();
        $teams = Team::all();

        // Manually create matches for the first round
        Matches::create([
            'tournament_id' => $tournament->id,
            'team1_id' => $teams[1]->id,
            'team2_id' => $teams[2]->id,
            'round' => 1,
        ]);

        Matches::create([
            'tournament_id' => $tournament->id,
            'team1_id' => $teams[3]->id,
            'team2_id' => $teams[4]->id,
            'round' => 1,
        ]);
    }
}
