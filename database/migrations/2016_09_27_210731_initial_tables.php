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
        Schema::create('data_sources', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('pitch_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->timestamps();
        });
        Schema::create('data_source_pitch_types', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('data_source_id')->unsigned();
            $table->foreign('data_source_id')->references('id')->on('data_sources');
            $table->string('code')->index();
            $table->timestamps();
        });
        Schema::create('data_source_pitch_type_matches', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('pitch_type_id')->unsigned();
            $table->foreign('pitch_type_id')->references('id')->on('pitch_types');
            $table->integer('data_source_pitch_type_id')->unsigned();
            $table->foreign('data_source_pitch_type_id')->references('id')->on('data_source_pitch_types');
            $table->timestamps();
        });
        Schema::create('event_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->timestamps();
        });
        Schema::create('data_source_event_codes', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('data_source_id')->unsigned();
            $table->foreign('data_source_id')->references('id')->on('data_sources');
            $table->string('code')->index();
            $table->timestamps();
        });
        Schema::create('data_source_event_code_matches', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('event_code_id')->unsigned();
            $table->foreign('event_code_id')->references('id')->on('event_codes');
            $table->integer('data_source_event_code_id')->unsigned();
            $table->foreign('data_source_event_code_id')->references('id')->on('data_source_event_codes');
            $table->timestamps();
        });
        Schema::create('batted_ball_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->timestamps();
        });
        Schema::create('data_source_batted_ball_types', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('data_source_id')->unsigned();
            $table->foreign('data_source_id')->references('id')->on('data_sources');
            $table->string('code')->index();
            $table->timestamps();
        });
        Schema::create('data_source_batted_ball_type_matches', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('batted_ball_type_id')->unsigned();
            $table->foreign('batted_ball_type_id')->references('id')->on('batted_ball_types');
            $table->integer('data_source_batted_ball_type_id')->unsigned();
            $table->foreign('data_source_batted_ball_type_id', 'data_source_batted_ball_type_matches_type_id_foreign')->references('id')->on('data_source_batted_ball_types');
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
            $table->string('pfx_id')->index();
            $table->date('date');
            $table->timestamps();
        });
        Schema::create('pfx_pitches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('line_number')->nullable()->unsigned()->index();
            $table->string('batter_name')->nullable();
            $table->integer('batter_id')->nullable()->unsigned();
            $table->foreign('batter_id')->references('mlb_id')->on('players');
            $table->string('pitcher_name')->nullable();
            $table->integer('pitcher_id')->nullable()->unsigned();
            $table->foreign('pitcher_id')->references('mlb_id')->on('players');
            $table->integer('inning')->nullable();
            $table->string('event_result')->nullable();
            $table->smallInteger('ballspre')->nullable();
            $table->smallInteger('strikespre')->nullable();
            $table->integer('sequence_number')->nullable();
            $table->integer('at_bat_number')->nullable();
            $table->string('pbp_number')->nullable();
            $table->string('initial_speed')->nullable();
            $table->string('pitch_name')->nullable();
            $table->string('game_id')->nullable()->index();
            $table->string('event_type')->nullable();
            $table->timestamps();
        });
        Schema::create('stats_pitches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('line_number')->nullable()->unsigned()->index();
            $table->string('batter_name')->nullable();
            $table->integer('batter_id')->nullable()->unsigned();
            $table->foreign('batter_id')->references('mlb_id')->on('players');
            $table->string('pitcher_name')->nullable();
            $table->integer('pitcher_id')->nullable()->unsigned();
            $table->foreign('pitcher_id')->references('mlb_id')->on('players');
            $table->integer('inning')->nullable();
            $table->smallInteger('ballspre')->nullable();
            $table->smallInteger('strikespre')->nullable();
            $table->integer('stats_event_number')->nullable();
            $table->integer('stats_sequence')->nullable();
            $table->decimal('stats_velocity',4,1)->nullable();
            $table->integer('stats_pitch_type_id')->nullable()->unsigned();
            $table->foreign('stats_pitch_type_id')->references('id')->on('pitch_types');
            $table->integer('stats_batted_ball_type_id')->nullable()->unsigned();
            $table->foreign('stats_batted_ball_type_id')->references('id')->on('batted_ball_types');
            $table->integer('stats_event_code_id')->nullable()->unsigned();
            $table->foreign('stats_event_code_id')->references('id')->on('event_codes');
            $table->date('date')->nullable()->index();
            $table->integer('home_team_id')->nullable()->unsigned();
            $table->foreign('home_team_id')->references('id')->on('teams');
            $table->integer('away_team_id')->nullable()->unsigned();
            $table->foreign('away_team_id')->references('id')->on('teams');
            $table->timestamps();
        });
        Schema::create('pitches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('game_id')->nullable()->unsigned();
            $table->foreign('game_id')->references('id')->on('games');
            $table->integer('batter_id')->nullable()->unsigned();
            $table->foreign('batter_id')->references('id')->on('players');
            $table->integer('pitcher_id')->nullable()->unsigned();
            $table->foreign('pitcher_id')->references('id')->on('players');
            $table->integer('inning')->nullable();
            $table->decimal('velocity',4,1)->nullable();
            $table->smallInteger('ballspre')->nullable();
            $table->smallInteger('strikespre')->nullable();
            $table->integer('pitch_type_id')->nullable()->unsigned();
            $table->foreign('pitch_type_id')->references('id')->on('pitch_types');
            $table->integer('batted_ball_type_id')->nullable()->unsigned();
            $table->foreign('batted_ball_type_id')->references('id')->on('batted_ball_types');
            $table->integer('event_code_id')->nullable()->unsigned();
            $table->foreign('event_code_id')->references('id')->on('event_codes');
            $table->integer('pitch_result_type_id')->nullable()->unsigned();
            $table->foreign('pitch_result_type_id')->references('id')->on('pitch_result_types');
            $table->timestamps();
        });
        Schema::create('discrepancies', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('pitch_id')->nullable()->unsigned();
            $table->foreign('pitch_id')->references('id')->on('pitches');
            $table->string('column_name')->nullable();
            $table->datetime('resolved')->nullable()->index();
            $table->enum('type', ['not_found', 'bad_data']);
            $table->timestamps();
        });
        Schema::create('discrepancy_data_sources', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('discrepancy_id')->unsigned();
            $table->foreign('discrepancy_id')->references('id')->on('discrepancies');
            $table->integer('data_source_id')->unsigned();
            $table->foreign('data_source_id')->references('id')->on('data_sources');
            $table->integer('data_source_table_id')->unsigned()->index();
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
        Schema::create('pitch_result_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code');
            $table->tinyInteger('ball')->default(0);
            $table->tinyInteger('strike')->default(0);
            $table->tinyInteger('foul')->default(0);
            $table->tinyInteger('end')->default(0);
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
        Schema::dropIfExists('pitch_result_types');
        Schema::dropIfExists('pitch_data_sources');
        Schema::dropIfExists('discrepancy_data_sources');
        Schema::dropIfExists('discrepancies');
        Schema::dropIfExists('pitches');
        Schema::dropIfExists('stats_pitches');
        Schema::dropIfExists('pfx_pitches');
        Schema::dropIfExists('games');
        Schema::dropIfExists('teams');
        Schema::dropIfExists('players');
        Schema::dropIfExists('data_source_batted_ball_type_matches');
        Schema::dropIfExists('data_source_batted_ball_types');
        Schema::dropIfExists('batted_ball_types');
        Schema::dropIfExists('data_source_event_code_matches');
        Schema::dropIfExists('data_source_event_codes');
        Schema::dropIfExists('event_codes');
        Schema::dropIfExists('data_source_pitch_type_matches');
        Schema::dropIfExists('data_source_pitch_types');
        Schema::dropIfExists('pitch_types');
        Schema::dropIfExists('data_sources');
    }
}
