<?php namespace App\Models;

use DB;

use Illuminate\Database\Eloquent\Model;

class Pitch extends Model {
	protected $table = 'pitches';
    
    public function pfx_pitch(){
        $ret = PfxPitch::whereIn('id', function($query){
            $query->select('data_source_table_id')
                ->from('pitch_data_sources')
                ->whereIn('data_source_id', function($query2){
                    $query2->select('id')
                        ->from('data_sources')
                        ->where('name', 'Pitch F/X');
                })
                ->where('pitch_id', $this->id);
        })->first();
        return $ret;
    }
    
    public function pfx_stats(){
        $ret = PfxPitch::whereIn('id', function($query){
            $query->select('data_source_table_id')
                ->from('pitch_data_sources')
                ->whereIn('data_source_id', function($query2){
                    $query2->select('id')
                        ->from('data_sources')
                        ->where('name', 'Stats');
                })
                ->where('pitch_id', $this->id);
        })->first();
        return $ret;
    }
    
    public function pitch_type(){
        return $this->belongsTo('App\Models\PitchType');
    }
    
    public function event_code(){
        $dsec = DataSourceEventCode::whereRaw('id in (select data_source_event_code_id from data_source_event_code_matches where event_code_id = ?)', [$this->event_code_id])
            ->where('data_source_id', DB::raw('2'))
            ->first();
            
        if ($dsec){
            return $dsec->code;
        }
    }
}