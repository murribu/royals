<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PitchType extends Model {
	protected $table = 'pitch_types';
    
    protected $fillable = ['stats_code', 'name'];
}