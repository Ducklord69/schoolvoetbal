<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('tournaments', function (Blueprint $table) {
        $table->dropColumn('status');
    });

    Schema::table('tournaments', function (Blueprint $table) {
        $table->enum('status', ['Not_started', 'In_progress', 'Completed'])
              ->default('Not_started');
    });
}

public function down()
{
    Schema::table('tournaments', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}
};
