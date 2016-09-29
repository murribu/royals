<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitialTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stats_code')->nullable()->unsigned()->index();
            $table->string('pfx_code')->nullable()->index();
            $table->string('name')->nullable();
            $table->timestamps();
        });
        Schema::create('pitch_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('stats_code')->nullable()->index();
            $table->string('pfx_code')->nullable()->index();
            $table->string('name')->nullable();
            $table->timestamps();
        });
        Schema::create('batted_ball_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('stats_code')->nullable()->index();
            $table->string('pfx_code')->nullable()->index();
            $table->string('name')->nullable();
            $table->timestamps();
        });
        Schema::create('players', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('mlb_id')->unsigned()->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->timestamps();
        });
        Schema::create('teams', function(Blueprint $table) {
            $table->increments('id');
            $table->string('stats_abbr')->nullable()->index();
            $table->string('pfx_abbr')->nullable()->index();
            $table->string('location')->nullable();
            $table->string('name')->nullable();
            $table->timestamps();
        });
        Schema::create('games', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('home_team_id')->unsigned();
            $table->foreign('home_team_id')->references('id')->on('teams');
            $table->integer('away_team_id')->unsigned();
            $table->foreign('away_team_id')->references('id')->on('teams');
            $table->date('date');
            $table->timestamps();
        });
        Schema::create('data_sources', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('pfx_pitches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('line_number')->unsigned()->index();
            $table->string('batter_name');
            $table->integer('batter_id')->unsigned();
            $table->foreign('batter_id')->references('mlb_id')->on('players');
            $table->string('pitcher_name');
            $table->integer('pitcher_id')->unsigned();
            $table->foreign('pitcher_id')->references('mlb_id')->on('players');
            $table->integer('inning');
            $table->string('event_result');
            $table->smallInteger('ballspre');
            $table->smallInteger('strikespre');
            $table->integer('sequence_number')->nullable();
            $table->integer('at_bat_number');
            $table->string('pbp_number');
            $table->string('pitch_name');
            $table->string('game_id')->index();
            $table->string('event_type');
            $table->timestamps();
        });
        Schema::create('stats_pitches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('line_number')->unsigned()->index();
            $table->string('batter_name');
            $table->integer('batter_id')->unsigned();
            $table->foreign('batter_id')->references('mlb_id')->on('players');
            $table->string('pitcher_name');
            $table->integer('pitcher_id')->unsigned();
            $table->foreign('pitcher_id')->references('mlb_id')->on('players');
            $table->integer('inning');
            $table->smallInteger('ballspre');
            $table->smallInteger('strikespre');
            $table->integer('stats_event_number');
            $table->integer('stats_sequence')->nullable();
            $table->decimal('stats_velocity',4,1)->nullable();
            $table->integer('stats_pitch_type_id')->unsigned();
            $table->foreign('stats_pitch_type_id')->references('id')->on('pitch_types');
            $table->integer('stats_batted_ball_type_id')->unsigned();
            $table->foreign('stats_batted_ball_type_id')->references('id')->on('batted_ball_types');
            $table->integer('stats_event_code_id')->unsigned();
            $table->foreign('stats_event_code_id')->references('id')->on('event_codes');
            $table->date('date')->index();
            $table->integer('home_team_id')->unsigned();
            $table->foreign('home_team_id')->references('id')->on('teams');
            $table->integer('away_team_id')->unsigned();
            $table->foreign('away_team_id')->references('id')->on('teams');
            $table->timestamps();
        });
        Schema::create('pitches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('game_id')->unsigned();
            $table->foreign('game_id')->references('id')->on('games');
            $table->integer('batter_id')->unsigned();
            $table->foreign('batter_id')->references('id')->on('players');
            $table->integer('pitcher_id')->unsigned();
            $table->foreign('pitcher_id')->references('id')->on('players');
            $table->integer('inning');
            $table->decimal('velocity',4,1);
            $table->smallInteger('ballspre');
            $table->smallInteger('strikespre');
            $table->integer('stats_pitch_type_id')->unsigned();
            $table->foreign('stats_pitch_type_id')->references('id')->on('pitch_types');
            $table->integer('stats_batted_ball_type_id')->unsigned();
            $table->foreign('stats_batted_ball_type_id')->references('id')->on('batted_ball_types');
            $table->integer('stats_event_code_id')->unsigned();
            $table->foreign('stats_event_code_id')->references('id')->on('event_codes');
            $table->integer('stats_sequence')->nullable();
            $table->integer('pfx_sequence_number')->nullable();
            $table->timestamps();
        });
        Schema::create('discrepancies', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('pitch_id')->unsigned();
            $table->foreign('pitch_id')->references('id')->on('pitches');
            $table->string('column_name');
            $table->integer('pfx_pitch_id')->unsigned();
            $table->foreign('pfx_pitch_id')->references('id')->on('pfx_pitches');
            $table->integer('stats_pitch_id')->unsigned();
            $table->foreign('stats_pitch_id')->references('id')->on('pfx_pitches');
            $table->datetime('resolved')->nullable()->index();
            $table->timestamps();
        });
        Schema::create('pitch_data_sources', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('pitch_id')->unsigned();
            $table->foreign('pitch_id')->references('id')->on('pitches');
            $table->integer('data_source_id')->unsigned();
            $table->foreign('data_source_id')->references('id')->on('data_sources');
            $table->integer('data_source_table_id')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pitch_data_sources');
        Schema::dropIfExists('discrepancies');
        Schema::dropIfExists('pitches');
        Schema::dropIfExists('stats_pitches');
        Schema::dropIfExists('pfx_pitches');
        Schema::dropIfExists('data_sources');
        Schema::dropIfExists('games');
        Schema::dropIfExists('teams');
        Schema::dropIfExists('players');
        Schema::dropIfExists('batted_ball_types');
        Schema::dropIfExists('pitch_types');
        Schema::dropIfExists('event_codes');
    }
}
