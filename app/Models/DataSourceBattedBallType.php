<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataSourceBattedBallType extends Model {
	protected $table = 'data_source_batted_ball_types';
    
    protected $fillable = ['data_source_id', 'code'];
}