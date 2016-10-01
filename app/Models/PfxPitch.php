<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PfxPitch extends Model {
	protected $table = 'pfx_pitches';
    
    public function batter(){
        return $this->belongsTo('App\Models\Player', 'batter_id', 'mlb_id');
    }
    
    public function pitcher(){
        return $this->belongsTo('App\Models\Player', 'pitcher_id', 'mlb_id');
    }
    
    public static function create_from_line($line, $headers){
        $p = self::where('line_number', $line['line_number'])->first();
        foreach($headers as $key=>$h){
            $line[$h] = $line[$key];
        }
        $prev = PfxPitch::where('line_number', $line['line_number'] - 1)->first();
        $pa_number = 1;
        $pa_sequence = 1;
        if ($prev && $prev->inning > 8 && $line['inning'] == '1'){
            //new game
            $pa_number = 1;
            $pa_sequence = 1;
        }else if ($prev && ($prev->batter_id != $line['batter_id'] || $prev->inning != $line['inning'])){
            //new pa
            $pa_number = $prev->pa_number + 1;
            $pa_sequence = 1;
        }else if ($prev){
            //continuing the pa
            $pa_number = $prev->pa_number;
            $pa_sequence = $prev->pa_sequence + 1;
        }
        if ($p){
            return ['success' => 0, 'message' => 'This PfxPitch already exists'];
        }else{
            $batter = Player::first_or_create_from_id_and_name($line['batter_id'], $line['batter_name']);
            $pitcher = Player::first_or_create_from_id_and_name($line['pitcher_id'], $line['pitcher_name']);
            $p = new PfxPitch;
            $p->line_number = $line['line_number'];
            $p->batter_name = $line['batter_name'];
            $p->batter_id = $line['batter_id'];
            $p->pitcher_name = $line['pitcher_name'];
            $p->pitcher_id = $line['pitcher_id'];
            $p->inning = $line['inning'];
            $p->event_result = $line['event_result'];
            $p->ballspre = $line['ballspre'];
            $p->strikespre = $line['strikespre'];
            if ($line['sequence_number'] != 'NA'){
                $p->sequence_number = $line['sequence_number'];
            }
            $p->at_bat_number = $line['at_bat_number'];
            $p->pbp_number = $line['pbp_number'];
            $p->initial_speed = $line['initial_speed'];
            $p->pitch_name = $line['pitch_name'];
            $p->game_id = $line['game_id'];
            $p->event_type = $line['event_type'];
            $p->pa_number = $pa_number;
            $p->pa_sequence = $pa_sequence;
            $p->save();
            
            return ['success' => 1, 'message' => 'Record created'];
        }
    }
}