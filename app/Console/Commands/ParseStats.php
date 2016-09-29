<?php
namespace App\Console\Commands;

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

class ParseStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parsestats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parses stats data';

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
        
        $csv_path = storage_path().'/stats_sample.csv';
        $csv = Reader::createFromPath($csv_path);
        
        $headers = $csv->fetchOne();

        $max_line_number = StatsPitch::max('line_number');
        $max_line_number = $max_line_number ? $max_line_number + 1 : 1;
        
        $set = $csv->setOffset($max_line_number)->setLimit(1000)->fetchAll();
        
        foreach($set as $num => $line){
            $line['line_number'] = $num + $max_line_number;
            $result = StatsPitch::create_from_line($line, $headers);
        }
    }
}