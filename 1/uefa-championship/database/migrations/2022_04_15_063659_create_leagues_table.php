<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leagues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id');
            $table->tinyInteger('points')->default(0);
            $table->tinyInteger('games')->default(0);
            $table->tinyInteger('win')->default(0);
            $table->tinyInteger('lose')->default(0);
            $table->tinyInteger('draw')->default(0);
            $table->tinyInteger('goal_diff')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leagues');
    }
};
