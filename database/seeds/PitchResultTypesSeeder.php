<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Models\PitchResultType;

class PitchResultTypesSeeder extends Seeder{
	public function run(){
        $pitch_result_types = array(
            array(
                'name' => 'Ball',
                'code' => 'ball',
                'ball' => '1',
                'strike' => '0',
                'foul' => '0',
                'end' => '0',
            ),
            array(
                'name' => 'In Play',
                'code' => 'hit_into_play',
                'ball' => '0',
                'strike' => '0',
                'foul' => '0',
                'end' => '1',
            ),
            array(
                'name' => 'Strike (Called)',
                'code' => 'called_strike',
                'ball' => '0',
                'strike' => '1',
                'foul' => '0',
                'end' => '0',
            ),
            array(
                'name' => 'In Play, no out',
                'code' => 'hit_into_play_no_out',
                'ball' => '0',
                'strike' => '0',
                'foul' => '0',
                'end' => '1',
            ),
            array(
                'name' => 'In Play, run(s) scored',
                'code' => 'hit_into_play_score',
                'ball' => '0',
                'strike' => '0',
                'foul' => '0',
                'end' => '1',
            ),
            array(
                'name' => 'Foul',
                'code' => 'foul',
                'ball' => '0',
                'strike' => '0',
                'foul' => '1',
                'end' => '0',
            ),
            array(
                'name' => 'Strike (Swinging)',
                'code' => 'swinging_strike',
                'ball' => '0',
                'strike' => '1',
                'foul' => '0',
                'end' => '0',
            ),
            array(
                'name' => 'Strike (Swinging, Blocked)',
                'code' => 'swinging_strike_blocked',
                'ball' => '0',
                'strike' => '1',
                'foul' => '0',
                'end' => '0',
            ),
            array(
                'name' => 'Blocked',
                'code' => 'blocked_ball',
                'ball' => '1',
                'strike' => '0',
                'foul' => '0',
                'end' => '0',
            ),
            array(
                'name' => 'Foul Bunt',
                'code' => 'foul_bunt',
                'ball' => '0',
                'strike' => '1',
                'foul' => '0',
                'end' => '0',
            ),
            array(
                'name' => 'Foul Tip',
                'code' => 'foul_tip',
                'ball' => '0',
                'strike' => '1',
                'foul' => '0',
                'end' => '0',
            ),
            array(
                'name' => 'Hit By Pitch',
                'code' => 'hit_by_pitch',
                'ball' => '0',
                'strike' => '0',
                'foul' => '0',
                'end' => '1',
            ),
            array(
                'name' => 'Intentional Ball',
                'code' => 'intent_ball',
                'ball' => '1',
                'strike' => '0',
                'foul' => '0',
                'end' => '0',
            ),
            array(
                'name' => 'Missed Bunt',
                'code' => 'missed_bunt',
                'ball' => '0',
                'strike' => '1',
                'foul' => '0',
                'end' => '0',
            ),
            array(
                'name' => 'Pitchout',
                'code' => 'pitchout',
                'ball' => '1',
                'strike' => '0',
                'foul' => '0',
                'end' => '0',
            ),
            array(
                'name' => 'Strike (Swinging, Pitchout)',
                'code' => 'swinging_pitchout',
                'ball' => '0',
                'strike' => '1',
                'foul' => '0',
                'end' => '0',
            ),
        );
        
        foreach($pitch_result_types as $pitch_type){
            $pt = PitchResultType::where('code', $pitch_type['code'])->first();
            if (!$pt){
                $pt = new PitchResultType;
                $pt->code = $pitch_type['code'];
            }
            $pt->name = $pitch_type['name'];
            $pt->ball = $pitch_type['ball'];
            $pt->strike = $pitch_type['strike'];
            $pt->foul = $pitch_type['foul'];
            $pt->end = $pitch_type['end'];
            $pt->save();
        }
    }
}