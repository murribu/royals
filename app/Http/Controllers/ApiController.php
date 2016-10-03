<?php
namespace App\Http\Controllers;

use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Game;
use App\Models\Pitch;

class ApiController extends Controller
{
    public function getYears(){
        $ret = Game::distinct()->selectRaw('year(`date`) y')->get();
        return $ret->pluck('y');
    }
    
    public function getMonths($year){
        $ret = Game::distinct()
            ->selectRaw('month(`date`) m')
            ->whereBetween('date', [$year.'-1-1', $year.'-12-31'])
            ->get();
        return $ret->pluck('m');
    }
    
    public function getDays($year, $month){
        $ret = Game::distinct()
            ->selectRaw('day(`date`) d')
            ->whereBetween('date', [date("Y-m-1", strtotime($year.'-'.$month.'-1')), date("Y-m-t", strtotime($year.'-'.$month.'-1'))])
            ->get();
        return $ret->pluck('d');
    }
    
    public function getGames($year, $month, $day){
        $games = Game::leftJoin('teams as home_team', 'home_team.id', '=', 'games.home_team_id')
            ->leftJoin('teams as away_team', 'away_team.id', '=', 'games.away_team_id')
            ->whereBetween('date', [$year.'-'.$month.'-'.$day, $year.'-'.$month.'-'.$day])
            ->select('home_team.name as home_team', 'away_team.name as away_team', 'games.id as game_id')
            ->get();
        return $games;
    }
    
    public function getGame($game_id){
        $game = Game::leftJoin('teams as home_team', 'home_team.id', '=', 'games.home_team_id')
            ->leftJoin('teams as away_team', 'away_team.id', '=', 'games.away_team_id')
            ->select('home_team.name as home_team', 'away_team.name as away_team', 'games.id as game_id', 'games.id')
            ->find($game_id);
        $game->innings = $game->innings();
        return $game;
    }
    
    public function getInning($game_id, $inning){
        return Pitch::where('game_id', $game_id)
            ->where('inning', $inning)
            ->leftJoin('players as batter', 'batter.id', '=', 'pitches.batter_id')
            ->leftJoin('players as pitcher', 'pitcher.id', '=', 'pitches.pitcher_id')
            ->selectRaw("batter.last_name as batter, pitcher.last_name pitcher, count(pitches.id) as pitch_count, pa_number")
            ->groupBy('pa_number', 'batter.first_name', 'batter.last_name', 'pitcher.first_name', 'pitcher.last_name', 'pa_number')
            ->get();
    }
    
    public function getPlateAppearance($game_id, $pa){
        return Pitch::where('game_id', $game_id)
            ->where('pa_number', $pa)
            ->get();
    }
}