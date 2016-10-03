<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatsGameIdFieldToGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->integer('stats_game_id')->nullable();
            $table->foreign('stats_game_id')->references('game_id')->on('stats_pitches');
        });
        Schema::table('pitches', function (Blueprint $table) {
            $table->integer('pa_number')->nullable();
            $table->integer('pa_sequence')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pitches', function (Blueprint $table) {
            $table->dropColumn('pa_number')->nullable();
            $table->dropColumn('pa_sequence')->nullable();
        });
        Schema::table('games', function (Blueprint $table) {
            $table->dropForeign('games_stats_game_id_foreign');
            $table->dropColumn('stats_game_id');
        });
    }
}
