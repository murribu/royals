<?php
namespace App\Console\Commands;

use DB;

use Illuminate\Console\Command;

use League\Csv\Reader;

use App\Models\DataSource;
use App\Models\Discrepancy;
use App\Models\Game;
use App\Models\PfxPitch;
use App\Models\Pitch;
use App\Models\Player;
use App\Models\BattedBallType;
use App\Models\EventCode;
use App\Models\StatsPitch;
use App\Models\PitchType;
use App\Models\Team;

class CompareSources extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'comparesources';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compares pfx and stats data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        //grab a game to parse if one needs it
        $source_pfx = DataSource::where('name', 'Pitch F/X')->first();
        $source_stats = DataSource::where('name', 'Stats')->first();
        
        DB::enableQueryLog();
        $game_id = PfxPitch::whereNotIn('id', function($query){
            $query->select('data_source_table_id')
                ->from('pitch_data_sources')
                ->where('data_source_id', function($query2){
                    $query2->select('id')
                        ->from('data_sources')
                        ->where('name', 'Pitch F/X');
                });
        })->whereNotIn('id', function($query){
            $query->select('data_source_table_id')
                ->from('discrepancy_data_sources')
                ->where('data_source_id', function($query2){
                    $query2->select('id')
                        ->from('data_sources')
                        ->where('name', 'Pitch F/X');
                });
        })->select('game_id')
        ->first();
        dd(DB::getQueryLog());
        $game_id = $game_id['game_id'];
        
        if ($game_id){
            $auto_columns = array(
                array(
                    'pfx'   => 'inning',
                    'stats' => 'inning',
                ),
                array(
                    'pfx'   => 'ballspre',
                    'stats' => 'ballspre',
                ),
                array(
                    'pfx'   => 'strikespre',
                    'stats' => 'strikespre',
                ),
            );
            $pfx_pitches = PfxPitch::where('game_id', $game_id)->orderBy('line_number')->get();
            foreach($pfx_pitches as $pfx){
                //try to find the corresponding stats record
                
                DB::enableQueryLog();
                $stat = StatsPitch::where('date', substr($game_id,0,4).'-'.substr($game_id,5,2).'-'.substr($game_id,8,2))
                    ->where('batter_id', $pfx->batter->mlb_id)
                    ->where('pitcher_id', $pfx->pitcher->mlb_id)
                    ->whereNotIn('id', function($query){
                        $query->select('data_source_table_id')
                            ->from('pitch_data_sources')
                            ->where('data_source_id', function($query2){
                                $query2->select('id')
                                    ->from('data_sources')
                                    ->where('name', 'Stats');
                            });
                    })->whereNotIn('id', function($query){
                        $query->select('pfx_pitch_id')
                            ->from('discrepancies');
                    })->first();
                // dd(DB::getQueryLog());
                if (!$stat){
                    $d = new Discrepancy;
                    $d->type = 'not_found';
                    $d->save();
                    $dds = new DiscrepancyDataSource;
                    $dds->discrepancy_id = $d->id;
                    $dds->data_source_id = $source_pfx->id;
                    $dds->data_source_table_id = $pfx->id;
                    $dds->save();
                }else{
                    $pitch = Pitch::where('id', function($query){
                        $query->select('pitch_id')
                            ->from('pitch_data_sources')
                            ->where('data_source_id', $source_pfx->id)
                            ->where('data_source_table_id', $pfx->id);
                    })->first();
                    if (!$pitch){
                        $game = Game::where('pfx_id', $pfx->game_id)->first();
                        if (!$game){
                            $away_team = Team::where('pfx_abbr', substr($pfx->game_id, 11, 6))->first();
                            if (!$away_team){
                                $away_team = new Team;
                                $away_team->pfx_abbr = substr($pfx->game_id, 11, 6);
                                $away_team->save();
                                $this->info('Added Team '.substr($pfx->game_id, 11, 6));
                            }
                            $home_team = Team::where('pfx_abbr', substr($pfx->game_id, 19, 6))->first();
                            if (!$home_team){
                                $home_team = new Team;
                                $home_team->pfx_abbr = substr($pfx->game_id, 19, 6);
                                $home_team->save();
                                $this->info('Added Team '.substr($pfx->game_id, 19, 6));
                            }
                            $game = new Game;
                            $game->pfx_id = $pfx->game_id;
                            $game->home_team_id = $home_team->id;
                            $game->away_team_id = $away_team->id;
                            $game->date = substr($pfx->game_id, 0, 4)."-".substr($pfx->game_id, 5, 2)."-".substr($pfx->game_id, 8, 2);
                            $game->save();
                        }
                        $batter = Player::where('mlb_id', $pfx->batter_id)->first();
                        if (!$batter){
                            $batter = new Player;
                            $batter->mlb_id = $pfx->batter_id;
                            $batter->first_name = substr($pfx->batter_name, strpos($pfx->batter_name, ',') + 2);
                            $batter->last_name = substr($pfx->batter_name, 0, strpos($pfx->batter_name, ','));
                            $batter->save();
                            $this->info('Added Player '.$pfx->batter_name);
                        }
                        $pitcher = Player::where('mlb_id', $pfx->pitcher_id)->first();
                        if (!$pitcher){
                            $pitcher = new Player;
                            $pitcher->mlb_id = $pfx->batter_id;
                            $pitcher->first_name = substr($pfx->pitcher_name, strpos($pfx->pitcher_name, ',') + 2);
                            $pitcher->last_name = substr($pfx->pitcher_name, 0, strpos($pfx->pitcher_name, ','));
                            $pitcher->save();
                            $this->info('Added Player '.$pfx->pitcher_name);
                        }
                        $data_source_pitch_type = DataSourcePitchType::where('data_source_id', $source_pfx->id)
                            ->where('code', $pfx->pitch_name)
                            ->first();
                        
                        $pitch_type = $data_source_pitch_type->pitch_type;
                        dd($pitch_type);
                        
                        DB::beginTransaction();
                        $pitch = new Pitch;
                        $pitch->game_id = $game->id;
                        $pitch->batter_id = $batter->id;
                        $pitch->pitcher_id = $pitcher->id;
                        $pitch->inning = $pfx->inning;
                        $pitch->velocity = $pfx->initial_speed;
                        $pitch->ballspre = $pfx->ballspre;
                        $pitch->strikespre = $pfx->strikespre;
                        $pitch->strikespre = $pfx->strikespre;
                        $pitch->pitch_type_id = $pitch_type->id;
                        DB::commit();
                    }
                    foreach($auto_columns as $col){
                        if ($pfx->{$col['pfx']} != $stat->{$col['stats']}){
                            $d = new Discrepancy;
                            $d->type = 'bad_data';
                            // $d->
                        }
                    }
                }
                var_dump($stat);
                
                return;
            }
        }
    }
}