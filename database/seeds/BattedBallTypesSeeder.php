<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Models\DataSource;
use App\Models\DataSourceBattedBallType;
use App\Models\DataSourceBattedBallTypeMatch;
use App\Models\BattedBallType;

class BattedBallTypesSeeder extends Seeder{
	public function run(){
        $batted_ball_types = array(
            array(
                'name' => 'NA',
                'matches' => array(
                    'stats' => array(
                        'NA'
                    ),
                ),
            ),
            array(
                'name' => 'Popup',
                'matches' => array(
                    'stats' => array(
                        'P'
                    ),
                ),
            ),
            array(
                'name' => 'Line Drive',
                'matches' => array(
                    'stats' => array(
                        'L'
                    ),
                ),
            ),
            array(
                'name' => 'Groundball',
                'matches' => array(
                    'stats' => array(
                        'G'
                    ),
                ),
            ),
            array(
                'name' => 'Flyball',
                'matches' => array(
                    'stats' => array(
                        'F'
                    ),
                ),
            ),
            array(
                'name' => 'Bunt',
                'matches' => array(
                    'stats' => array(
                        'B'
                    ),
                ),
            ),
        );
        $data_source_pfx = DataSource::where('name', 'Pitch F/X')->first();
        $data_source_stats = DataSource::where('name', 'Stats')->first();
        foreach ($batted_ball_types as $batted_ball_type){
            $ec = BattedBallType::where('name', $batted_ball_type['name'])->first();
            if (!$ec){
                $ec = new BattedBallType;
                $ec->name = $batted_ball_type['name'];
                $ec->save();
            }
            // foreach($batted_ball_type['matches']['pfx'] as $pfx_code){
                // $type = DataSourceBattedBallType::firstOrCreate(['data_source_id' => $data_source_pfx->id, 'code' => $pfx_code]);
                // $match = DataSourceBattedBallTypeMatch::firstOrCreate(['batted_ball_type_id' => $ec->id, 'data_source_batted_ball_type_id' => $type->id]);
            // }
            foreach($batted_ball_type['matches']['stats'] as $stats_code){
                $type = DataSourceBattedBallType::firstOrCreate(['data_source_id' => $data_source_stats->id, 'code' => $stats_code]);
                $match = DataSourceBattedBallTypeMatch::firstOrCreate(['batted_ball_type_id' => $ec->id, 'data_source_batted_ball_type_id' => $type->id]);
            }
        }
    }
}