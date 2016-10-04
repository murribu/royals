<?php namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class Game extends Model {
	protected $table = 'games';
    
    public function home_team(){
        return $this->belongsTo('App\Models\Team', 'home_team_id');
    }
    
    public function away_team(){
        return $this->belongsTo('App\Models\Team', 'away_team_id');
    }
    
    public function innings($ignore_pitch_type_discrepancies){
        $query = "select inning, count(discrepancies.id) discrepancies
        from pitches 
        left join discrepancies on discrepancies.pitch_id = pitches.id and discrepancies.resolved is null ";
        if ($ignore_pitch_type_discrepancies == 'true'){
            $query .= " and discrepancies.column_name != 'pitch_type' ";
        }
        $query .= " 
        where game_id = ?
        group by inning
        ";
        $ret = DB::select($query, [$this->id]);
        return $ret;
    }
    
    public function pitches(){
        return $this->hasMany('App\Models\Pitch')->orderBy('pa_number')->orderBy('pa_sequence');
    }
    
    public function pfx_pitches(){
        return $this->hasMany('App\Models\PfxPitch')->orderBy('pa_number')->orderBy('pa_sequence');
    }
    
    public function stats_pitches(){
        return $this->hasMany('App\Models\StatsPitch')->orderBy('pa_number')->orderBy('pa_sequence');
    }
}