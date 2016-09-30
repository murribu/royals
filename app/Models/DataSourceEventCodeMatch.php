<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataSourceEventCodeMatch extends Model {
	protected $table = 'data_source_event_code_matches';
    
    protected $fillable = ['event_code_id', 'data_source_event_code_id'];
}