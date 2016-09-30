<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Models\DataSource;
use App\Models\DataSourcePitchType;
use App\Models\DataSourcePitchTypeMatch;
use App\Models\PitchType;

class PitchTypesSeeder extends Seeder{
	public function run(){
        $pitch_types = array(
            array(
                'name' => 'Sinker',
                'matches' => array(
                    'pfx' => array(
                        'Sinker'
                    ),
                    'stats' => array(
                        'N'
                    ),
                ),
            ),
            array(
                'name' => 'Slider',
                'matches' => array(
                    'pfx' => array(
                        'Sinker'
                    ),
                    'stats' => array(
                        'N'
                    ),
                ),
            ),
            array(
                'name' => 'Changeup',
                'matches' => array(
                    'pfx' => array(
                        'Changeup'
                    ),
                    'stats' => array(
                        'H'
                    ),
                ),
            ),
            array(
                'name' => 'Curveball',
                'matches' => array(
                    'pfx' => array(
                        'Curveball'
                    ),
                    'stats' => array(
                        'C'
                    ),
                ),
            ),
            array(
                'name' => 'Cutter',
                'matches' => array(
                    'pfx' => array(
                        'Cutter'
                    ),
                    'stats' => array(
                        'T'
                    ),
                ),
            ),
            array(
                'name' => 'Knuckle Curve',
                'matches' => array(
                    'pfx' => array(
                        'Knuckle Curve'
                    ),
                    'stats' => array(
                        'C'
                    ),
                ),
            ),
            array(
                'name' => 'Intentional Ball',
                'matches' => array(
                    'pfx' => array(
                        'Intentional Ball'
                    ),
                    'stats' => array(
                        'NA'
                    ),
                ),
            ),
            array(
                'name' => 'Splitter',
                'matches' => array(
                    'pfx' => array(
                        'Splitter'
                    ),
                    'stats' => array(
                        'P'
                    ),
                ),
            ),
            array(
                'name' => 'Forkball',
                'matches' => array(
                    'pfx' => array(
                        'Forkball'
                    ),
                    'stats' => array(
                        'P'
                    ),
                ),
            ),
            array(
                'name' => 'Pitchout',
                'matches' => array(
                    'pfx' => array(
                        'Pitchout'
                    ),
                    'stats' => array(
                        'NA'
                    ),
                ),
            ),
            array(
                'name' => 'Knuckleball',
                'matches' => array(
                    'pfx' => array(
                        'Knuckleball'
                    ),
                    'stats' => array(
                        'K'
                    ),
                ),
            ),
            array(
                'name' => 'Eephus Pitch',
                'matches' => array(
                    'pfx' => array(
                        'Eephus Pitch'
                    ),
                    'stats' => array(
                        'K'
                    ),
                ),
            ),
            array(
                'name' => 'Fastball',
                'matches' => array(
                    'pfx' => array(
                        'Fastball',
                        'Two-seam FB',
                        'Four-seam FB'
                    ),
                    'stats' => array(
                        'F'
                    ),
                ),
            ),
            array(
                'name' => 'No pitch',
                'matches' => array(
                    'pfx' => array(
                        'NA'
                    ),
                    'stats' => array(
                        'NA',
                        ''
                    ),
                ),
            ),
            array(
                'name' => 'Screwball',
                'matches' => array(
                    'pfx' => array(
                        'Screwball'
                    ),
                    'stats' => array(
                        'S'
                    ),
                ),
            ),
            array(
                'name' => 'Unknown',
                'matches' => array(
                    'pfx' => array(
                        'Unknown'
                    ),
                    'stats' => array(
                        'NA',
                        ''
                    ),
                ),
            ),
        );
        $data_source_pfx = DataSource::where('name', 'Pitch F/X')->first();
        $data_source_stats = DataSource::where('name', 'Stats')->first();
        foreach ($pitch_types as $pitch_type){
            $pt = PitchType::where('name', $pitch_type['name'])->first();
            if (!$pt){
                $pt = new PitchType;
                $pt->name = $pitch_type['name'];
                $pt->save();
            }
            foreach($pitch_type['matches']['pfx'] as $pfx_type){
                $type = DataSourcePitchType::firstOrCreate(['data_source_id' => $data_source_pfx->id, 'code' => $pfx_type]);
                $match = DataSourcePitchTypeMatch::firstOrCreate(['pitch_type_id' => $pt->id, 'data_source_pitch_type_id' => $type->id]);
            }
            foreach($pitch_type['matches']['stats'] as $stats_type){
                $type = DataSourcePitchType::firstOrCreate(['data_source_id' => $data_source_stats->id, 'code' => $stats_type]);
                $match = DataSourcePitchTypeMatch::firstOrCreate(['pitch_type_id' => $pt->id, 'data_source_pitch_type_id' => $type->id]);
            }
        }
	}
}