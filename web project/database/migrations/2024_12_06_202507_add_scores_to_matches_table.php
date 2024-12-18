<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddScoresToMatchesTable extends Migration
{
    public function up()
    {
        // Adding team1_score and team2_score columns to the matches table
        Schema::table('matches', function (Blueprint $table) {
            $table->integer('team1_score')->nullable()->after('team2_id'); // Team 1's score
            $table->integer('team2_score')->nullable()->after('team1_score'); // Team 2's score
        });
    }

    public function down()
    {
        // Dropping team1_score and team2_score columns if rolling back
        Schema::table('matches', function (Blueprint $table) {
            $table->dropColumn(['team1_score', 'team2_score']);
        });
    }
}
