<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataSourceBattedBallType extends Model {
	protected $table = 'data_source_batted_ball_types';
    
    protected $fillable = ['data_source_id', 'code'];
    
    public function matches(){
        return $this->hasMany('App\Models\DataSourceBattedBallTypeMatch');
    }
    
    public function batted_ball_type(){
        return $this->matches->first()->batted_ball_type;;
    }
}