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
        $games = Game::with('home_team', 'away_team')
            ->whereBetween('date', [$year.'-'.$month.'-'.$day, $year.'-'.$month.'-'.$day])
            ->get();
        return $games;
    }
}