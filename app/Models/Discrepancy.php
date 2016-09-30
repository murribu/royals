<?php namespace App\Models;

use DB;

use Illuminate\Database\Eloquent\Model;

class Discrepancy extends Model {
	protected $table = 'discrepancies';
    
    public static function create_from_bad_data($col, $pitch, $pfx, $stat){
        $source_pfx = DataSource::where('name', 'Pitch F/X')->first();
        $source_stats = DataSource::where('name', 'Stats')->first();
        
        DB::beginTransaction();
        $d = new Discrepancy;
        $d->type = 'bad_data';
        $d->column_name = $col;
        $d->pitch_id = $pitch->id;
        $d->save();
        
        $dds = new DiscrepancyDataSource;
        $dds->discrepancy_id = $d->id;
        $dds->data_source_id = $source_pfx->id;
        $dds->data_source_table_id = $pfx->id;
        $dds->save();
        
        $dds = new DiscrepancyDataSource;
        $dds->discrepancy_id = $d->id;
        $dds->data_source_id = $source_stats->id;
        $dds->data_source_table_id = $stat->id;
        $dds->save();
        DB::commit();
        
        return $d;
    }
}