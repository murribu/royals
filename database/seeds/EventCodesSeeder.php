<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Models\StatsBattedBallType;
use App\Models\StatsEventCode;
use App\Models\StatsPitchType;

class EventCodesSeeder extends Seeder{
	public function run(){
        $stati = array(
            array(
                'code' => '1',
                'name' => 'Lineup Chge',
            ),
            array(
                'code' => '2',
                'name' => 'Run Off Pitcher',
            ),
            array(
                'code' => '3',
                'name' => 'Run Scored',
            ),
            array(
                'code' => '4',
                'name' => 'Single',
            ),
            array(
                'code' => '6',
                'name' => 'Double',
            ),
            array(
                'code' => '7',
                'name' => 'Triple',
            ),
            array(
                'code' => '8',
                'name' => 'Home Run',
            ),
            array(
                'code' => '9',
                'name' => 'Pitches Only',
            ),
            array(
                'code' => '10',
                'name' => 'Game-Winng RBI',
            ),
            array(
                'code' => '11',
                'name' => 'Sacrifice Hit',
            ),
            array(
                'code' => '12',
                'name' => 'Sacrifice Fly',
            ),
            array(
                'code' => '13',
                'name' => 'Hit by Pitch',
            ),
            array(
                'code' => '14',
                'name' => 'Walk',
            ),
            array(
                'code' => '15',
                'name' => 'Intentl BB',
            ),
            array(
                'code' => '16',
                'name' => 'Strikeout',
            ),
            array(
                'code' => '17',
                'name' => 'Stolen Base',
            ),
            array(
                'code' => '18',
                'name' => 'Caught Stealing',
            ),
            array(
                'code' => '19',
                'name' => 'Ground DP',
            ),
            array(
                'code' => '20',
                'name' => '1B/Interference',
            ),
            array(
                'code' => '21',
                'name' => '1B/K+Wild Pitch',
            ),
            array(
                'code' => '22',
                'name' => '1B/K+Passed Ball',
            ),
            array(
                'code' => '23',
                'name' => '1B/K+Error',
            ),
            array(
                'code' => '24',
                'name' => '1B/Failed FC',
            ),
            array(
                'code' => '25',
                'name' => '1B/Error',
            ),
            array(
                'code' => '26',
                'name' => '2B/Error',
            ),
            array(
                'code' => '27',
                'name' => '3B/Error',
            ),
            array(
                'code' => '28',
                'name' => '1B/SacBunt+FC',
            ),
            array(
                'code' => '29',
                'name' => '1B/SacBunt+Err',
            ),
            array(
                'code' => '30',
                'name' => '1B/BallHitsRunnr',
            ),
            array(
                'code' => '31',
                'name' => 'Flied Out',
            ),
            array(
                'code' => '32',
                'name' => 'Foul Fly Out',
            ),
            array(
                'code' => '33',
                'name' => 'Ground Out',
            ),
            array(
                'code' => '34',
                'name' => 'Line Out',
            ),
            array(
                'code' => '35',
                'name' => 'Bunt Out',
            ),
            array(
                'code' => '36',
                'name' => 'Pop Out',
            ),
            array(
                'code' => '37',
                'name' => 'Foul Pop Out',
            ),
            array(
                'code' => '38',
                'name' => 'Force Out/Fielder\'s Choice',
            ),
            array(
                'code' => '41',
                'name' => 'GDP on Bunt',
            ),
            array(
                'code' => '43',
                'name' => 'Bunt Fly DP',
            ),
            array(
                'code' => '44',
                'name' => 'Line DP',
            ),
            array(
                'code' => '45',
                'name' => 'Grd Triple Play',
            ),
            array(
                'code' => '46',
                'name' => 'Line TriplePlay',
            ),
            array(
                'code' => '47',
                'name' => 'Bunt Fly Out',
            ),
            array(
                'code' => '48',
                'name' => 'Wild Pitch',
            ),
            array(
                'code' => '49',
                'name' => 'Passed Ball',
            ),
            array(
                'code' => '50',
                'name' => 'Balk',
            ),
            array(
                'code' => '51',
                'name' => 'CS + Error',
            ),
            array(
                'code' => '52',
                'name' => '4B Error',
            ),
            array(
                'code' => '53',
                'name' => 'Fly DP',
            ),
            array(
                'code' => '54',
                'name' => 'Double Steal',
            ),
            array(
                'code' => '55',
                'name' => 'Triple Steal',
            ),
            array(
                'code' => '56',
                'name' => 'SB + Error',
            ),
            array(
                'code' => '58',
                'name' => 'Misc.DP',
            ),
            array(
                'code' => '59',
                'name' => 'SF+Error',
            ),
            array(
                'code' => '60',
                'name' => 'SacF+OutAdv',
            ),
            array(
                'code' => '61',
                'name' => 'Btr Obstruction',
            ),
            array(
                'code' => '62',
                'name' => '2B/SacBunt+Err',
            ),
            array(
                'code' => '63',
                'name' => '3B/SacBunt+Err',
            ),
            array(
                'code' => '64',
                'name' => 'FC+Err',
            ),
            array(
                'code' => '65',
                'name' => '4B/SacBunt+Err',
            ),
            array(
                'code' => '66',
                'name' => 'Foul Bunt PO',
            ),
            array(
                'code' => '67',
                'name' => 'FC Ground DP',
            ),
            array(
                'code' => '68',
                'name' => 'FC Bunt GDP',
            ),
            array(
                'code' => '69',
                'name' => 'FC Ground TP',
            ),
            array(
                'code' => '70',
                'name' => 'Bat Out Of Order',
            ),
            array(
                'code' => '71',
                'name' => 'Batter Skipped',
            ),
            array(
                'code' => '72',
                'name' => 'Other DP',
            ),
            array(
                'code' => '73',
                'name' => 'Pop DP',
            ),
            array(
                'code' => '74',
                'name' => 'Sac Fly FC',
            ),
            array(
                'code' => '75',
                'name' => 'Strikeout+FC',
            ),
            array(
                'code' => '76',
                'name' => 'Double, Run. Out',
            ),
            array(
                'code' => '90',
                'name' => 'Pickoff',
            ),
            array(
                'code' => '91',
                'name' => 'Out Advancing',
            ),
            array(
                'code' => '92',
                'name' => 'Out Obstruction',
            ),
            array(
                'code' => '93',
                'name' => 'Advance-No Play',
            ),
            array(
                'code' => '94',
                'name' => 'Err/Pick Off',
            ),
            array(
                'code' => '95',
                'name' => 'Advance on Throw',
            ),
            array(
                'code' => '96',
                'name' => 'Advance, Error',
            ),
            array(
                'code' => '97',
                'name' => 'Error, Foul Fly',
            ),
            array(
                'code' => '98',
                'name' => 'Adv.Obstrctn',
            ),
        );
        
        foreach ($stati as $status){
            $s = StatsEventCode::where('code', $status['code'])->first();
            if (!$s){
                $s = new StatsEventCode;
                $s->code = $status['code'];
            }
            $s->name = $status['name'];
            $s->save();
        }
        
        $pitch_types = array(
            array(
                'code' => 'F',
                'name' => 'Fastball',
            ),
            array(
                'code' => 'C',
                'name' => 'Curve',
            ),
            array(
                'code' => 'S',
                'name' => 'Slider',
            ),
            array(
                'code' => 'H',
                'name' => 'Changeup',
            ),
            array(
                'code' => 'N',
                'name' => 'Sinker',
            ),
            array(
                'code' => 'K',
                'name' => 'Knuckleball',
            ),
            array(
                'code' => 'U',
                'name' => 'Unknown',
            ),
            array(
                'code' => 'P',
                'name' => 'Split-Finger/Forkball',
            ),
            array(
                'code' => 'T',
                'name' => 'Cut Fastball',
            ),
        );
        
        foreach ($pitch_types as $type){
            $s = StatsPitchType::where('code', $type['code'])->first();
            if (!$s){
                $s = new StatsPitchType;
                $s->code = $type['code'];
            }
            $s->name = $type['name'];
            $s->save();
        }
        
        $batted_ball_types = array(
            array(
                'code' => 'P',
                'name' => 'Popup',
            ),
            array(
                'code' => 'B',
                'name' => 'Bunt',
            ),
            array(
                'code' => 'F',
                'name' => 'Flyball',
            ),
            array(
                'code' => 'L',
                'name' => 'Line Drive',
            ),
            array(
                'code' => 'G',
                'name' => 'Groundball',
            ),
        );
        
        foreach ($batted_ball_types as $type){
            $s = StatsBattedBallType::where('code', $type['code'])->first();
            if (!$s){
                $s = new StatsBattedBallType;
                $s->code = $type['code'];
            }
            $s->name = $type['name'];
            $s->save();
        }
	}
}