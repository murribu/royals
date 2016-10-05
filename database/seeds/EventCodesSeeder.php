<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Models\DataSource;
use App\Models\DataSourceEventCode;
use App\Models\DataSourceEventCodeMatch;
use App\Models\EventCode;

class EventCodesSeeder extends Seeder{
	public function run(){
        $event_codes = array(
            array(
                'name' => '1B/BallHitsRunnr',
                'matches' => array(
                    'stats' => array(
                        '30'
                    ),
                    'pfx' => array(
                        'single'
                    ),
                ),
            ),
            array(
                'name' => '1B/Error',
                'matches' => array(
                    'stats' => array(
                        '25'
                    ),
                    'pfx' => array(
                        'field_error'
                    ),
                ),
            ),
            array(
                'name' => '1B/Failed FC',
                'matches' => array(
                    'stats' => array(
                        '24'
                    ),
                    'pfx' => array(
                        'fielders_choice',
                        'fielders_choice_out',
                    ),
                ),
            ),
            array(
                'name' => '1B/Interference',
                'matches' => array(
                    'stats' => array(
                        '20'
                    ),
                    'pfx' => array(
                        'single'
                    ),
                ),
            ),
            array(
                'name' => '1B/K+Error',
                'matches' => array(
                    'stats' => array(
                        '23'
                    ),
                    'pfx' => array(
                        'strikeout'
                    ),
                ),
            ),
            array(
                'name' => '1B/K+Passed Ball',
                'matches' => array(
                    'stats' => array(
                        '22'
                    ),
                    'pfx' => array(
                        'strikeout'
                    ),
                ),
            ),
            array(
                'name' => '1B/K+Wild Pitch',
                'matches' => array(
                    'stats' => array(
                        '21'
                    ),
                    'pfx' => array(
                        'strikeout'
                    ),
                ),
            ),
            array(
                'name' => '1B/SacBunt+Err',
                'matches' => array(
                    'stats' => array(
                        '29'
                    ),
                    'pfx' => array(
                        'sac_bunt'
                    ),
                ),
            ),
            array(
                'name' => '1B/SacBunt+FC',
                'matches' => array(
                    'stats' => array(
                        '28'
                    ),
                    'pfx' => array(
                        'sac_bunt'
                    ),
                ),
            ),
            array(
                'name' => '2B/Error',
                'matches' => array(
                    'stats' => array(
                        '26'
                    ),
                    'pfx' => array(
                        'field_error'
                    ),
                ),
            ),
            array(
                'name' => '2B/SacBunt+Err',
                'matches' => array(
                    'stats' => array(
                        '62'
                    ),
                    'pfx' => array(
                        'sac_bunt'
                    ),
                ),
            ),
            array(
                'name' => '3B/Error',
                'matches' => array(
                    'stats' => array(
                        '27'
                    ),
                    'pfx' => array(
                        'field_error'
                    ),
                ),
            ),
            array(
                'name' => 'Balk',
                'matches' => array(
                    'stats' => array(
                        '50'
                    ),
                    'pfx' => array(
                        'balk'
                    ),
                ),
            ),
            array(
                'name' => 'Btr Obstruction',
                'matches' => array(
                    'stats' => array(
                        '61'
                    ),
                    'pfx' => array(
                        'field_out'
                    ),
                ),
            ),
            array(
                'name' => 'Bunt Fly DP',
                'matches' => array(
                    'stats' => array(
                        '43'
                    ),
                    'pfx' => array(
                        'double_play'
                    ),
                ),
            ),
            array(
                'name' => 'Bunt Fly Out',
                'matches' => array(
                    'stats' => array(
                        '47'
                    ),
                    'pfx' => array(
                        'field_out'
                    ),
                ),
            ),
            array(
                'name' => 'Bunt Out',
                'matches' => array(
                    'stats' => array(
                        '35'
                    ),
                    'pfx' => array(
                        'field_out'
                    ),
                ),
            ),
            array(
                'name' => 'Caught Stealing',
                'matches' => array(
                    'stats' => array(
                        '18'
                    ),
                    'pfx' => array(
                        'caught_stealing_2b',
                        'caught_stealing_3b',
                        'caught_stealing_home'
                    ),
                ),
            ),
            array(
                'name' => 'Double',
                'matches' => array(
                    'stats' => array(
                        '6'
                    ),
                    'pfx' => array(
                        'double'
                    ),
                ),
            ),
            array(
                'name' => 'FC Ground DP',
                'matches' => array(
                    'stats' => array(
                        '67'
                    ),
                    'pfx' => array(
                        'grounded_into_double_play'
                    ),
                ),
            ),
            array(
                'name' => 'FC+Err',
                'matches' => array(
                    'stats' => array(
                        '64'
                    ),
                    'pfx' => array(
                        'field_error'
                    ),
                ),
            ),
            array(
                'name' => 'Flied Out',
                'matches' => array(
                    'stats' => array(
                        '31'
                    ),
                    'pfx' => array(
                        'field_out'
                    ),
                ),
            ),
            array(
                'name' => 'Fly DP',
                'matches' => array(
                    'stats' => array(
                        '53'
                    ),
                    'pfx' => array(
                        'double_play'
                    ),
                ),
            ),
            array(
                'name' => 'Force Out/Fielder\'s Choice',
                'matches' => array(
                    'stats' => array(
                        '38'
                    ),
                    'pfx' => array(
                        'force_out'
                    ),
                ),
            ),
            array(
                'name' => 'Foul Bunt PO',
                'matches' => array(
                    'stats' => array(
                        '66'
                    ),
                    'pfx' => array(
                        'field_out'
                    ),
                ),
            ),
            array(
                'name' => 'Foul Fly Out',
                'matches' => array(
                    'stats' => array(
                        '32'
                    ),
                    'pfx' => array(
                        'field_out'
                    ),
                ),
            ),
            array(
                'name' => 'Foul Pop Out',
                'matches' => array(
                    'stats' => array(
                        '37'
                    ),
                    'pfx' => array(
                        'field_out'
                    ),
                ),
            ),
            array(
                'name' => 'GDP on Bunt',
                'matches' => array(
                    'stats' => array(
                        '41'
                    ),
                    'pfx' => array(
                        'grounded_into_double_play'
                    ),
                ),
            ),
            array(
                'name' => 'Grd Triple Play',
                'matches' => array(
                    'stats' => array(
                        '45'
                    ),
                    'pfx' => array(
                        'triple_play'
                    ),
                ),
            ),
            array(
                'name' => 'Ground DP',
                'matches' => array(
                    'stats' => array(
                        '19'
                    ),
                    'pfx' => array(
                        'grounded_into_double_play'
                    ),
                ),
            ),
            array(
                'name' => 'Ground Out',
                'matches' => array(
                    'stats' => array(
                        '33'
                    ),
                    'pfx' => array(
                        'field_out'
                    ),
                ),
            ),
            array(
                'name' => 'Hit by Pitch',
                'matches' => array(
                    'stats' => array(
                        '13'
                    ),
                    'pfx' => array(
                        'hit_by_pitch'
                    ),
                ),
            ),
            array(
                'name' => 'Home Run',
                'matches' => array(
                    'stats' => array(
                        '8'
                    ),
                    'pfx' => array(
                        'home_run'
                    ),
                ),
            ),
            array(
                'name' => 'Intentl BB',
                'matches' => array(
                    'stats' => array(
                        '15'
                    ),
                    'pfx' => array(
                        'intent_walk'
                    ),
                ),
            ),
            array(
                'name' => 'Line DP',
                'matches' => array(
                    'stats' => array(
                        '44'
                    ),
                    'pfx' => array(
                        'double_play'
                    ),
                ),
            ),
            array(
                'name' => 'Line Out',
                'matches' => array(
                    'stats' => array(
                        '34'
                    ),
                    'pfx' => array(
                        'field_out'
                    ),
                ),
            ),
            array(
                'name' => 'Line TriplePlay',
                'matches' => array(
                    'stats' => array(
                        '46'
                    ),
                    'pfx' => array(
                        'triple_play'
                    ),
                ),
            ),
            array(
                'name' => 'Other DP',
                'matches' => array(
                    'stats' => array(
                        '72'
                    ),
                    'pfx' => array(
                        'double_play'
                    ),
                ),
            ),
            array(
                'name' => 'Out Advancing',
                'matches' => array(
                    'stats' => array(
                        '91'
                    ),
                    'pfx' => array(
                        'other_out'
                    ),
                ),
            ),
            array(
                'name' => 'Pickoff',
                'matches' => array(
                    'stats' => array(
                        '90'
                    ),
                    'pfx' => array(
                        'NA'
                    ),
                ),
            ),
            array(
                'name' => 'Pitches Only',
                'matches' => array(
                    'stats' => array(
                        '9'
                    ),
                    'pfx' => array(
                        'NA'
                    ),
                ),
            ),
            array(
                'name' => 'Pop DP',
                'matches' => array(
                    'stats' => array(
                        '73'
                    ),
                    'pfx' => array(
                        'double_play'
                    ),
                ),
            ),
            array(
                'name' => 'Pop Out',
                'matches' => array(
                    'stats' => array(
                        '36'
                    ),
                    'pfx' => array(
                        'field_out'
                    ),
                ),
            ),
            array(
                'name' => 'Sacrifice Fly',
                'matches' => array(
                    'stats' => array(
                        '12'
                    ),
                    'pfx' => array(
                        'sac_fly'
                    ),
                ),
            ),
            array(
                'name' => 'Sacrifice Hit',
                'matches' => array(
                    'stats' => array(
                        '11'
                    ),
                    'pfx' => array(
                        'sac_bunt'
                    ),
                ),
            ),
            array(
                'name' => 'SF+Error',
                'matches' => array(
                    'stats' => array(
                        '59'
                    ),
                    'pfx' => array(
                        'sac_fly'
                    ),
                ),
            ),
            array(
                'name' => 'Single',
                'matches' => array(
                    'stats' => array(
                        '4'
                    ),
                    'pfx' => array(
                        'single'
                    ),
                ),
            ),
            array(
                'name' => 'Strikeout',
                'matches' => array(
                    'stats' => array(
                        '16'
                    ),
                    'pfx' => array(
                        'strikeout',
                        'strikeout_double_play',
                    ),
                ),
            ),
            array(
                'name' => 'Strikeout+FC',
                'matches' => array(
                    'stats' => array(
                        '75'
                    ),
                    'pfx' => array(
                        'strikeout'
                    ),
                ),
            ),
            array(
                'name' => 'Triple',
                'matches' => array(
                    'stats' => array(
                        '7'
                    ),
                    'pfx' => array(
                        'triple'
                    ),
                ),
            ),
            array(
                'name' => 'Walk',
                'matches' => array(
                    'stats' => array(
                        '14'
                    ),
                    'pfx' => array(
                        'walk'
                    ),
                ),
            ),
            array(
                'name' => 'Wild Pitch',
                'matches' => array(
                    'stats' => array(
                        '48'
                    ),
                    'pfx' => array(
                        'wild_pitch'
                    ),
                ),
            ),
            array(
                'name' => 'Passed Ball',
                'matches' => array(
                    'stats' => array(
                        '4'
                    ),
                    'pfx' => array(
                        'passed_ball'
                    ),
                ),
            ),
            array(
                'name' => 'Stolen Base',
                'matches' => array(
                    'stats' => array(
                        '17'
                    ),
                    'pfx' => array(
                        'stolen_base_2b',
                        'stolen_base_3b',
                        'stolen_base_home',
                    ),
                ),
            ),
        );
        $data_source_pfx = DataSource::where('name', 'Pitch F/X')->first();
        $data_source_stats = DataSource::where('name', 'Stats')->first();
        foreach ($event_codes as $event_code){
            $ec = EventCode::where('name', $event_code['name'])->first();
            if (!$ec){
                $ec = new EventCode;
                $ec->name = $event_code['name'];
                $ec->save();
            }
            foreach($event_code['matches']['pfx'] as $pfx_code){
                $type = DataSourceEventCode::firstOrCreate(['data_source_id' => $data_source_pfx->id, 'code' => $pfx_code]);
                $match = DataSourceEventCodeMatch::firstOrCreate(['event_code_id' => $ec->id, 'data_source_event_code_id' => $type->id]);
            }
            foreach($event_code['matches']['stats'] as $stats_code){
                $type = DataSourceEventCode::firstOrCreate(['data_source_id' => $data_source_stats->id, 'code' => $stats_code]);
                $match = DataSourceEventCodeMatch::firstOrCreate(['event_code_id' => $ec->id, 'data_source_event_code_id' => $type->id]);
            }
        }
    }
}