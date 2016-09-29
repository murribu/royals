<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventCode extends Model {
	protected $table = 'event_codes';
    
    protected $fillable = ['stats_code', 'pfx_code'];
}