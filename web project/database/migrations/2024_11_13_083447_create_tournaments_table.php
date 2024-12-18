<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTournamentsTable extends Migration
{
    public function up()
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            
            $table->string('type')->default('single-elimination');
            $table->enum('status', ['not_started', 'in_progress', 'completed'])->default('not_started');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Links to users table
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tournaments');
    }
}
