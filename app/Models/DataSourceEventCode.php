<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataSourceEventCode extends Model {
	protected $table = 'data_source_event_codes';
    
    protected $fillable = ['data_source_id', 'code'];
}