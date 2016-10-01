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
}