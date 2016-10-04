<?php
namespace App\Http\Controllers;

use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\DataSourceEventCode;
use App\Models\DataSourcePitchType;
use App\Models\Discrepancy;
use App\Models\Game;
use App\Models\Pitch;
use App\Models\PfxPitch;
use App\Models\StatsPitch;

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
            ->select('home_team.name as home_team', 'away_team.name as away_team', 'games.id as game_id', 'games.id', DB::raw("concat('http://www.baseball-reference.com/boxes/', home_team.bbref, '/', home_team.bbref, year(games.date), lpad(month(games.date), 2, '0'), lpad(day(games.date), 2, '0'), '0.shtml#div_play_by_play') as bbref_url"))
            ->find($game_id);
        $game->innings = $game->innings();
        return $game;
    }
    
    public function getInning($game_id, $inning){
        $query = "select batter.last_name as batter, pitcher.last_name pitcher, count(pitches.id) as pitch_count, pa_number, count(discrepancies.id) discrepancies 
            from `pitches` 
            left join `players` as `batter` on `batter`.`id` = `pitches`.`batter_id` left join `players` as `pitcher` on `pitcher`.`id` = `pitches`.`pitcher_id` 
            left join `discrepancies` on `discrepancies`.`pitch_id` = `pitches`.`id` and `discrepancies`.`resolved` is null
            where `game_id` = ? and `inning` = ? 
            group by `pa_number`, `batter`.`first_name`, `batter`.`last_name`, `pitcher`.`first_name`, `pitcher`.`last_name`, `pa_number`";

        return DB::select($query, [$game_id, $inning]);
    }
    
    public function getPlateAppearance($game_id, $pa){
        $pitches = Pitch::where('game_id', $game_id)
            ->where('pa_number', $pa)
            ->get();
            
        foreach($pitches as $pitch){
            $pitch->event_type = $pitch->event_code();
        }
            
        foreach($pitches as $pitch){
            $pitch->pitch_type_name = $pitch->pitch_type->name;
        }
        
        $pfx_query = "select pfx_pitches.id, pfx_pitches.pa_sequence, pfx_pitches.initial_speed, pfx_pitches.pitch_name, discrepancies.pitch_id, pfx_pitches.event_result event_type, group_concat(distinct discrepancies.column_name) discrepancies_str
            from `pfx_pitches` 
            left join `discrepancy_data_sources` on `discrepancy_data_sources`.`data_source_table_id` = `pfx_pitches`.`id` and `discrepancy_data_sources`.`data_source_id` = 2 
            left join `discrepancies` on `discrepancies`.`id` = `discrepancy_data_sources`.`discrepancy_id` and `discrepancies`.`resolved` is null 
            where `game_id` = (select `pfx_id` from `games` where `id` = ?) and `pa_number` = ? 
            group by `pfx_pitches`.`id`, `pfx_pitches`.`pa_sequence`, `pfx_pitches`.`initial_speed`, `pfx_pitches`.`pitch_name`, `discrepancies`.`pitch_id`, pfx_pitches.event_result";

        $pfx = DB::select($pfx_query, [$game_id, $pa]);
        
        $stats_query = "select stats_pitches.id, stats_pitches.pa_sequence, stats_pitches.stats_velocity, pitch_types.name pitch_name, discrepancies.pitch_id, event_codes.name event_type, group_concat(distinct discrepancies.column_name) discrepancies_str 
            from `stats_pitches` left join `discrepancy_data_sources` on `discrepancy_data_sources`.`data_source_table_id` = `stats_pitches`.`id` and `discrepancy_data_sources`.`data_source_id` = 1 
            left join `discrepancies` on `discrepancies`.`id` = `discrepancy_data_sources`.`discrepancy_id` and `discrepancies`.`resolved` is null 
            left join `pitch_types` on `pitch_types`.`id` = `stats_pitches`.`stats_pitch_type_id` 
            left join data_source_event_codes on data_source_event_codes.code = stats_pitches.stats_event_code_id
            left join (select min(event_code_id) event_code, data_source_event_code_id from data_source_event_code_matches group by data_source_event_code_id) dsecm on dsecm.data_source_event_code_id = data_source_event_codes.id
            left join event_codes on dsecm.event_code = event_codes.id
            where `game_id` = (select `stats_game_id` from `games` where `id` = ?) and `pa_number` = ? 
            group by `stats_pitches`.`id`, `stats_pitches`.`pa_sequence`, `stats_pitches`.`stats_velocity`, `pitch_types`.`name`, `discrepancies`.`pitch_id`, event_codes.name";
        
        $stats = DB::select($stats_query, [$game_id, $pa]);

        return compact('pitches', 'pfx', 'stats');
    }
    
    public function getDiscrepancy($pitch_id, $column_name){
        $d = Discrepancy::where('pitch_id', $pitch_id)
            ->where('column_name', $column_name)
            ->first();
            
        $ret = [];
        switch ($column_name){
            case 'pitch_type':
                $ret['pfx'] = $d->pfx_pitch()->first()->pitch_name;
                $ret['stats'] = $d->stats_pitch()->first()->pitch_type->name;
                $ret['truth'] = $d->pitch->pitch_type->name;
                break;
            case 'event_code':
                $ret['pfx'] = $d->pfx_pitch()->first()->event_result;
                $ret['stats'] = $d->stats_pitch()->first()->event_code ? $d->stats_pitch()->first()->event_code->name : '';
                $ret['truth'] = $d->pitch->event_code();
                break;
        }
        
        return $ret;
    }
    
    public function postDiscrepancy($pitch_id, $column_name){
        $d = Discrepancy::where('pitch_id', $pitch_id)
            ->where('column_name', $column_name)
            ->first();
            
        $new_truth_source = Input::get('source');

        $pitch = $d->pitch;

        switch ($column_name){
            case 'pitch_type':
                if ($new_truth_source == 'pfx'){
                    $dspt = DataSourcePitchType::where('code', $d->pfx_pitch()->first()->pitch_name)
                        ->where('data_source_id', DB::raw('2'))
                        ->first();
                    $pitch->pitch_type_id = $dspt->pitch_type()->id;
                }elseif($new_truth_source == 'stats'){
                    $pitch->pitch_type_id = $d->stats_pitch()->first()->pitch_type->id;
                }
                $pitch->save();
                break;
            case 'event_code':
                if ($new_truth_source == 'pfx'){
                    $dsec = DataSourceEventCode::where('code', $d->pfx_pitch()->first()->event_result)
                        ->where('data_source_id', DB::raw('2'))
                        ->first();
                    $pitch->event_code_id = $dsec->event_code()->id;
                }elseif($new_truth_source == 'stats'){
                    $pitch->event_code_id = $d->stats_pitch()->first()->stats_event_code_id;
                }
                $pitch->save();
                break;
        }
    }
    
    public function postResolveDiscrepancy($pitch_id, $column_name){
        $d = Discrepancy::where('pitch_id', $pitch_id)
            ->where('column_name', $column_name)
            ->first();
            
        $d->resolved = date("Y-m-d g:i:s");
        $d->save();
    }
}