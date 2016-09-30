<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataSourcePitchType extends Model {
	protected $table = 'data_source_pitch_types';
    
    protected $fillable = ['data_source_id', 'code'];
}