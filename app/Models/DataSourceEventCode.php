<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataSourceEventCode extends Model {
	protected $table = 'data_source_event_codes';
    
    protected $fillable = ['data_source_id', 'code'];
    
    public function matches(){
        return $this->hasMany('App\Models\DataSourceEventCodeMatch');
    }
    
    public function event_code(){
        return $this->matches->first()->event_code;
    }
    
    public function does_match($event_code, $source){
        if ($event_code){
            $code_ids = DataSourceEventCodeMatch::where('data_source_event_code_id', $this->id)->pluck('event_code_id')->toArray();
            
            return in_array($event_code->id, $code_ids);
        }else{
            return false;
        }
    }
}