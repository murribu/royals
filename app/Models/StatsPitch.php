<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatsPitch extends Model {
	protected $table = 'stats_pitches';
    
    public function event_code(){
        return $this->belongsTo('App\Models\EventCode', 'stats_event_code_id');
    }
    
    public function pitch_type(){
        return $this->belongsTo('App\Models\PitchType', 'stats_pitch_type_id');
    }
    
    public static function create_from_line($line, $headers, $next){
        $p = self::where('line_number', $line['line_number'])->first();
        $source_stats = DataSource::where('name', 'Stats')->first();
        foreach($headers as $key=>$h){
            $line[$h] = $line[$key];
        }
        foreach($headers as $key=>$h){
            $next[$h] = $next[$key];
        }
        $prev = StatsPitch::where('line_number', $line['line_number'] - 1)->first();
        $pa_number = 1;
        $pa_sequence = 1;
        $game_id = 990000;
        if ($prev && $prev->inning > 8 && $line['inning'] == '1'){
            //new game
            $pa_number = 1;
            $pa_sequence = 1;
            $game_id = $prev->game_id + 1;
        }else if ($prev && ($prev->batter_id != $line['batter_id'] || $prev->inning != $line['inning'])){
            //new pa
            $pa_number = $prev->pa_number + 1;
            $pa_sequence = 1;
            $game_id = $prev->game_id;
        }else if ($prev){
            //continuing the pa
            $pa_number = $prev->pa_number;
            $pa_sequence = $prev->pa_sequence + 1;
            $game_id = $prev->game_id;
        }
        if ($p){
            return ['success' => 0, 'message' => 'This StatsPitch already exists'];
        }else{
            $batter = Player::first_or_create_from_id_and_name($line['batter_id'], $line['batter_name']);
            $pitcher = Player::first_or_create_from_id_and_name($line['pitcher_id'], $line['pitcher_name']);
            $data_source_pitch_type = DataSourcePitchType::firstOrCreate(['code' => $line['statspitchtype'], 'data_source_id' => $source_stats->id]);
            $pitch_type = $data_source_pitch_type->pitch_type();
            $data_source_batted_ball_type = DataSourceBattedBallType::firstOrCreate(['code' => $line['battedballtype'], 'data_source_id' => $source_stats->id]);
            $batted_ball_type = $data_source_batted_ball_type->batted_ball_type();
            $data_source_event = DataSourceEventCode::firstOrCreate(['code' => $line['event'], 'data_source_id' => $source_stats->id]);
            $event_code = $data_source_event->event_code();
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
            if ($next && ($next['inning'] != $line['inning'] || $next['batter_id'] != $line['batter_id'])){
                //last pitch of pa
                $p->stats_event_code_id = $event_code->id;
            }
            $p->date = $line['year'].'-'.$line['month'].'-'.$line['day'];
            $p->home_team_id = $home_team->id;
            $p->away_team_id = $away_team->id;
            $p->pa_number = $pa_number;
            $p->pa_sequence = $pa_sequence;
            $p->game_id = $game_id;
            if (@$p->save()){
                return ['success' => 1, 'message' => 'Record created'];
            }else{
                return ['success' => 0, 'message' => 'This StatsPitch already existed after it was prepared'];
            }
            
        }
    }
}