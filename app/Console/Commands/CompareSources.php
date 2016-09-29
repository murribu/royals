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
        
        $game_id = PfxPitch::whereNotIn('id', function($query){
            $query->select('data_source_table_id')
                ->from('pitch_data_sources')
                ->where('data_source_id', function($query2){
                    $query2->select('id')
                        ->from('data_sources')
                        ->where('name', 'Pitch F/X');
                });
        })->whereNotIn('id', function($query){
            $query->select('pfx_pitch_id')
                ->from('discrepancies');
        })->select('game_id')
        ->first();
        
        $game_id = $game_id['game_id'];
        
        if ($game_id){
            $columns = array(
                array(
                    'pfx'   => 'batter_id',
                    'stats' => 'batter_id',
                ),
                array(
                    'pfx'   => 'inning',
                    'stats' => 'inning',
                ),
                array(
                    'pfx'   => '$[![col]!]',
                    'stats' => '$[![col]!]',
                ),
                array(
                    'pfx'   => 'ballspre',
                    'stats' => 'ballspre',
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
                    
                }
                var_dump($stat);
                
                return;
            }
        }
    }
}