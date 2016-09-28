<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Models\DataSource;

class DataSourcesSeeder extends Seeder{
	public function run(){
        $sources = array(
            array(
                'name' => 'Stats'
            ),
            array(
                'name' => 'Pitch F/X'
            ),
            array(
                'name' => 'Calculated'  //Like 'Ballspre' or 'Strikespre' - those can be calculated on the fly
            ),
            array(
                'name' => 'Manual'  //Resolving a discrepancy from an outside data source (like bbref or fangraphs)
            ),
        );
        
        foreach($sources as $source){
            $s = DataSource::where('name', $source['name'])->first();
            if (!$s){
                $s = new DataSource;
            }
            $s->name = $source['name'];
            $s->save();
        }
    }
}