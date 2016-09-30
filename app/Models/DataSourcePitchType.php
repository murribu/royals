<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataSourcePitchType extends Model {
	protected $table = 'data_source_pitch_types';
    
    protected $fillable = ['data_source_id', 'code'];
    
    public function matches(){
        return $this->hasMany('App\Models\DataSourcePitchTypeMatch');
    }
    
    public function pitch_type(){
        return $this->matches->first()->pitch_type;
    }
    
    public function does_match($pitch_type, $source){
        $pitch_type_ids = DataSourcePitchTypeMatch::where('data_source_pitch_type_id', $this->id)->pluck('pitch_type_id')->toArray();
        
        return in_array($pitch_type->id, $pitch_type_ids);
    }
}