<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model {
	protected $table = 'games';
    
    public function home_team(){
        return $this->belongsTo('App\Models\Team', 'home_team_id');
    }
    
    public function away_team(){
        return $this->belongsTo('App\Models\Team', 'away_team_id');
    }
    
    public function innings(){
        return Pitch::where('game_id', $this->id)
            ->select('inning')
            ->distinct()
            ->get()
            ->pluck('inning');
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