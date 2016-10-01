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

class ParsePfx extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parsepfx';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parses pfx data';

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
        
        $csv_path = storage_path().'/pfx_sample.csv';
        $csv = Reader::createFromPath($csv_path);
        
        $headers = $csv->fetchOne();

        $max_line_number = PfxPitch::max('line_number');
        $max_line_number = $max_line_number ? $max_line_number : 0;
        
        $max_line_number++;
        $set = $csv->setOffset($max_line_number)->setLimit(1000)->fetchAll();
        
        foreach($set as $num => $line){
            $line['line_number'] = $num + $max_line_number;
            $result = PfxPitch::create_from_line($line, $headers);
        }
    }
}