<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BattedBallType extends Model {
	protected $table = 'batted_ball_types';
    
    protected $fillable = ['stats_code', 'name'];
}