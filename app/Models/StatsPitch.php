<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatsPitch extends Model {
	protected $table = 'stats_pitches';
    
    public static function create_from_line($line, $headers){
        $p = self::where('line_number', $line['line_number'])->first();
        foreach($headers as $key=>$h){
            $line[$h] = $line[$key];
        }
        if ($p){
            return ['success' => 0, 'message' => 'This StatsPitch already exists'];
        }else{
            $batter = Player::first_or_create_from_id_and_name($line['batter_id'], $line['batter_name']);
            $pitcher = Player::first_or_create_from_id_and_name($line['pitcher_id'], $line['pitcher_name']);
            $pitch_type = PitchType::firstOrCreate(['stats_code' => $line['statspitchtype']]);
            $batted_ball_type = BattedBallType::firstOrCreate(['stats_code' => $line['battedballtype']]);
            $event = EventCode::firstOrCreate(['stats_code' => $line['event']]);
            $away_team = Team::firstOrCreate(['stats_abbr' => $line['away_team']]);
            $home_team = Team::firstOrCreate(['stats_abbr' => $line['home_team']]);
            
            $p = new StatsPitch;
            $p->line_number = $line['line_number'];
            $p->batter_name = $line['batter_name'];
            $p->batter_id = $line['batter_id'];
            $p->pitcher_name = $line['pitcher_name'];
            $p->pitcher_id = $line['pitcher_id'];
            $p->inning = $line['inning'];
            $p->ballspre = $line['ballspre'];
            $p->strikespre = $line['strikespre'];
            $p->stats_event_number = $line['stats_event_number'];
            $p->stats_sequence = $line['stats_sequence'];
            if ($line['stats_velocity'] != 'NA'){
                $p->stats_velocity = $line['stats_velocity'];
            }
            $p->stats_pitch_type_id = $pitch_type->id;
            $p->stats_batted_ball_type_id = $batted_ball_type->id;
            $p->stats_event_code_id = $event->id;
            $p->date = $line['year'].'-'.$line['month'].'-'.$line['day'];
            $p->home_team_id = $home_team->id;
            $p->away_team_id = $away_team->id;
            $p->save();
            
            return ['success' => 1, 'message' => 'Record created'];
        }
    }
}