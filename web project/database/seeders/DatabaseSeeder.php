<?php

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\TournamentSeeder;
use Database\Seeders\TeamSeeder;
use Database\Seeders\MatchSeeder;

class DatabaseSeeder extends Seeder
{
        public function run()
    {
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            TournamentSeeder::class,
            TeamSeeder::class,
            MatchSeeder::class,
        ]);
    }

}
