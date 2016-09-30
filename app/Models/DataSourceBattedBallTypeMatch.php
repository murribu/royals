<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataSourceBattedBallTypeMatch extends Model {
	protected $table = 'data_source_batted_ball_type_matches';
    
    protected $fillable = ['batted_ball_type_id', 'data_source_batted_ball_type_id'];
    
    public function batted_ball_type(){
        return $this->belongsTo('App\Models\BattedBallType');
    }
}