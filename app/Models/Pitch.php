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
}