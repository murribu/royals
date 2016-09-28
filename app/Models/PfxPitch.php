<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PfxPitch extends Model {
	protected $table = 'pfx_pitches';
    
    public static function create_from_line($line, $headers){
        $p = self::where('line_number', $line['line_number'])->first();
        foreach($headers as $key=>$h){
            $line[$h] = $line[$key];
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
            $p->sequence_number = $line['sequence_number'];
            $p->at_bat_number = $line['at_bat_number'];
            $p->pbp_number = $line['pbp_number'];
            $p->pitch_name = $line['pitch_name'];
            $p->game_id = $line['game_id'];
            $p->event_type = $line['event_type'];
            $p->save();
            
            return ['success' => 1, 'message' => 'Record created'];
        }
    }
}