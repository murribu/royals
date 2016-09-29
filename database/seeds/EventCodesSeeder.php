<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Models\BattedBallType;
use App\Models\EventCode;
use App\Models\PitchType;

class EventCodesSeeder extends Seeder{
	public function run(){
        $stati = array(
            array(
                'stats_code' => '1',
                'name' => 'Lineup Chge',
            ),
            array(
                'stats_code' => '2',
                'name' => 'Run Off Pitcher',
            ),
            array(
                'stats_code' => '3',
                'name' => 'Run Scored',
            ),
            array(
                'stats_code' => '4',
                'name' => 'Single',
            ),
            array(
                'stats_code' => '6',
                'name' => 'Double',
            ),
            array(
                'stats_code' => '7',
                'name' => 'Triple',
            ),
            array(
                'stats_code' => '8',
                'name' => 'Home Run',
            ),
            array(
                'stats_code' => '9',
                'name' => 'Pitches Only',
            ),
            array(
                'stats_code' => '10',
                'name' => 'Game-Winng RBI',
            ),
            array(
                'stats_code' => '11',
                'name' => 'Sacrifice Hit',
            ),
            array(
                'stats_code' => '12',
                'name' => 'Sacrifice Fly',
            ),
            array(
                'stats_code' => '13',
                'name' => 'Hit by Pitch',
            ),
            array(
                'stats_code' => '14',
                'name' => 'Walk',
            ),
            array(
                'stats_code' => '15',
                'name' => 'Intentl BB',
            ),
            array(
                'stats_code' => '16',
                'name' => 'Strikeout',
            ),
            array(
                'stats_code' => '17',
                'name' => 'Stolen Base',
            ),
            array(
                'stats_code' => '18',
                'name' => 'Caught Stealing',
            ),
            array(
                'stats_code' => '19',
                'name' => 'Ground DP',
            ),
            array(
                'stats_code' => '20',
                'name' => '1B/Interference',
            ),
            array(
                'stats_code' => '21',
                'name' => '1B/K+Wild Pitch',
            ),
            array(
                'stats_code' => '22',
                'name' => '1B/K+Passed Ball',
            ),
            array(
                'stats_code' => '23',
                'name' => '1B/K+Error',
            ),
            array(
                'stats_code' => '24',
                'name' => '1B/Failed FC',
            ),
            array(
                'stats_code' => '25',
                'name' => '1B/Error',
            ),
            array(
                'stats_code' => '26',
                'name' => '2B/Error',
            ),
            array(
                'stats_code' => '27',
                'name' => '3B/Error',
            ),
            array(
                'stats_code' => '28',
                'name' => '1B/SacBunt+FC',
            ),
            array(
                'stats_code' => '29',
                'name' => '1B/SacBunt+Err',
            ),
            array(
                'stats_code' => '30',
                'name' => '1B/BallHitsRunnr',
            ),
            array(
                'stats_code' => '31',
                'name' => 'Flied Out',
            ),
            array(
                'stats_code' => '32',
                'name' => 'Foul Fly Out',
            ),
            array(
                'stats_code' => '33',
                'name' => 'Ground Out',
            ),
            array(
                'stats_code' => '34',
                'name' => 'Line Out',
            ),
            array(
                'stats_code' => '35',
                'name' => 'Bunt Out',
            ),
            array(
                'stats_code' => '36',
                'name' => 'Pop Out',
            ),
            array(
                'stats_code' => '37',
                'name' => 'Foul Pop Out',
            ),
            array(
                'stats_code' => '38',
                'name' => 'Force Out/Fielder\'s Choice',
            ),
            array(
                'stats_code' => '41',
                'name' => 'GDP on Bunt',
            ),
            array(
                'stats_code' => '43',
                'name' => 'Bunt Fly DP',
            ),
            array(
                'stats_code' => '44',
                'name' => 'Line DP',
            ),
            array(
                'stats_code' => '45',
                'name' => 'Grd Triple Play',
            ),
            array(
                'stats_code' => '46',
                'name' => 'Line TriplePlay',
            ),
            array(
                'stats_code' => '47',
                'name' => 'Bunt Fly Out',
            ),
            array(
                'stats_code' => '48',
                'name' => 'Wild Pitch',
            ),
            array(
                'stats_code' => '49',
                'name' => 'Passed Ball',
            ),
            array(
                'stats_code' => '50',
                'name' => 'Balk',
            ),
            array(
                'stats_code' => '51',
                'name' => 'CS + Error',
            ),
            array(
                'stats_code' => '52',
                'name' => '4B Error',
            ),
            array(
                'stats_code' => '53',
                'name' => 'Fly DP',
            ),
            array(
                'stats_code' => '54',
                'name' => 'Double Steal',
            ),
            array(
                'stats_code' => '55',
                'name' => 'Triple Steal',
            ),
            array(
                'stats_code' => '56',
                'name' => 'SB + Error',
            ),
            array(
                'stats_code' => '58',
                'name' => 'Misc.DP',
            ),
            array(
                'stats_code' => '59',
                'name' => 'SF+Error',
            ),
            array(
                'stats_code' => '60',
                'name' => 'SacF+OutAdv',
            ),
            array(
                'stats_code' => '61',
                'name' => 'Btr Obstruction',
            ),
            array(
                'stats_code' => '62',
                'name' => '2B/SacBunt+Err',
            ),
            array(
                'stats_code' => '63',
                'name' => '3B/SacBunt+Err',
            ),
            array(
                'stats_code' => '64',
                'name' => 'FC+Err',
            ),
            array(
                'stats_code' => '65',
                'name' => '4B/SacBunt+Err',
            ),
            array(
                'stats_code' => '66',
                'name' => 'Foul Bunt PO',
            ),
            array(
                'stats_code' => '67',
                'name' => 'FC Ground DP',
            ),
            array(
                'stats_code' => '68',
                'name' => 'FC Bunt GDP',
            ),
            array(
                'stats_code' => '69',
                'name' => 'FC Ground TP',
            ),
            array(
                'stats_code' => '70',
                'name' => 'Bat Out Of Order',
            ),
            array(
                'stats_code' => '71',
                'name' => 'Batter Skipped',
            ),
            array(
                'stats_code' => '72',
                'name' => 'Other DP',
            ),
            array(
                'stats_code' => '73',
                'name' => 'Pop DP',
            ),
            array(
                'stats_code' => '74',
                'name' => 'Sac Fly FC',
            ),
            array(
                'stats_code' => '75',
                'name' => 'Strikeout+FC',
            ),
            array(
                'stats_code' => '76',
                'name' => 'Double, Run. Out',
            ),
            array(
                'stats_code' => '90',
                'name' => 'Pickoff',
            ),
            array(
                'stats_code' => '91',
                'name' => 'Out Advancing',
            ),
            array(
                'stats_code' => '92',
                'name' => 'Out Obstruction',
            ),
            array(
                'stats_code' => '93',
                'name' => 'Advance-No Play',
            ),
            array(
                'stats_code' => '94',
                'name' => 'Err/Pick Off',
            ),
            array(
                'stats_code' => '95',
                'name' => 'Advance on Throw',
            ),
            array(
                'stats_code' => '96',
                'name' => 'Advance, Error',
            ),
            array(
                'stats_code' => '97',
                'name' => 'Error, Foul Fly',
            ),
            array(
                'stats_code' => '98',
                'name' => 'Adv.Obstrctn',
            ),
        );
        
        foreach ($stati as $status){
            $s = EventCode::where('stats_code', $status['stats_code'])->first();
            if (!$s){
                $s = new EventCode;
                $s->stats_code = $status['stats_code'];
            }
            $s->name = $status['name'];
            $s->save();
        }
        
        $pitch_types = array(
            array(
                'stats_code' => 'F',
                'name' => 'Fastball',
            ),
            array(
                'stats_code' => 'C',
                'name' => 'Curve',
            ),
            array(
                'stats_code' => 'S',
                'name' => 'Slider',
            ),
            array(
                'stats_code' => 'H',
                'name' => 'Changeup',
            ),
            array(
                'stats_code' => 'N',
                'name' => 'Sinker',
            ),
            array(
                'stats_code' => 'K',
                'name' => 'Knuckleball',
            ),
            array(
                'stats_code' => 'U',
                'name' => 'Unknown',
            ),
            array(
                'stats_code' => 'P',
                'name' => 'Split-Finger/Forkball',
            ),
            array(
                'stats_code' => 'T',
                'name' => 'Cut Fastball',
            ),
        );
        
        foreach ($pitch_types as $type){
            $s = PitchType::where('stats_code', $type['stats_code'])->first();
            if (!$s){
                $s = new PitchType;
                $s->stats_code = $type['stats_code'];
            }
            $s->name = $type['name'];
            $s->save();
        }
        
        $batted_ball_types = array(
            array(
                'stats_code' => 'P',
                'name' => 'Popup',
            ),
            array(
                'stats_code' => 'B',
                'name' => 'Bunt',
            ),
            array(
                'stats_code' => 'F',
                'name' => 'Flyball',
            ),
            array(
                'stats_code' => 'L',
                'name' => 'Line Drive',
            ),
            array(
                'stats_code' => 'G',
                'name' => 'Groundball',
            ),
        );
        
        foreach ($batted_ball_types as $type){
            $s = BattedBallType::where('stats_code', $type['stats_code'])->first();
            if (!$s){
                $s = new BattedBallType;
                $s->stats_code = $type['stats_code'];
            }
            $s->name = $type['name'];
            $s->save();
        }
	}
}