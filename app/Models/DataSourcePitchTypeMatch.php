<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataSourcePitchTypeMatch extends Model {
	protected $table = 'data_source_pitch_type_matches';
    
    protected $fillable = ['pitch_type_id', 'data_source_pitch_type_id'];
    
    public function pitch_type(){
        return $this->belongsTo('App\Models\PitchType');
    }
}