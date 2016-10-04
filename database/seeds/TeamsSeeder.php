<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Models\Team;
use App\Models\League;

class TeamsSeeder extends Seeder{
	public function run(){
        
        $leagues = array(
            'AL',
            'NL'
        );
        
        $teams = array(
            array(
                'stats_abbr' => 'ana',
                'pfx_abbr' => 'anamlb',
                'league' => 'AL',
                'bbref' => 'LAA',
                'location' => 'Los Angeles',
                'name' => 'Angels of Anaheim',
            ),
            array(
                'stats_abbr' => 'ari',
                'pfx_abbr' => 'arimlb',
                'league' => 'NL',
                'bbref' => 'ARI',
                'location' => 'Arizona',
                'name' => 'Diamondbacks',
            ),
            array(
                'stats_abbr' => 'bal',
                'pfx_abbr' => 'balmlb',
                'league' => 'AL',
                'bbref' => 'BAL',
                'location' => 'Baltimore',
                'name' => 'Orioles',
            ),
            array(
                'stats_abbr' => 'atl',
                'pfx_abbr' => 'atlmlb',
                'league' => 'NL',
                'bbref' => 'ATL',
                'location' => 'Atlanta',
                'name' => 'Braves',
            ),
            array(
                'stats_abbr' => 'chn',
                'pfx_abbr' => 'chnmlb',
                'league' => 'NL',
                'bbref' => 'CHC',
                'location' => 'Chicago',
                'name' => 'Cubs',
            ),
            array(
                'stats_abbr' => 'bos',
                'pfx_abbr' => 'bosmlb',
                'league' => 'AL',
                'bbref' => 'BOS',
                'location' => 'Boston',
                'name' => 'Red Sox',
            ),
            array(
                'stats_abbr' => 'cin',
                'pfx_abbr' => 'cinmlb',
                'league' => 'NL',
                'bbref' => 'CIN',
                'location' => 'Cincinnati',
                'name' => 'Reds',
            ),
            array(
                'stats_abbr' => 'cha',
                'pfx_abbr' => 'chamlb',
                'league' => 'AL',
                'bbref' => 'CHW',
                'location' => 'Chicago',
                'name' => 'White Sox',
            ),
            array(
                'stats_abbr' => 'cle',
                'pfx_abbr' => 'clemlb',
                'league' => 'AL',
                'bbref' => 'CLE',
                'location' => 'Cleveland',
                'name' => 'Indians',
            ),
            array(
                'stats_abbr' => 'col',
                'pfx_abbr' => 'colmlb',
                'league' => 'NL',
                'bbref' => 'COL',
                'location' => 'Colorado',
                'name' => 'Rockies',
            ),
            array(
                'stats_abbr' => 'lan',
                'pfx_abbr' => 'lanmlb',
                'league' => 'NL',
                'bbref' => 'LAD',
                'location' => 'Los Angeles',
                'name' => 'Dodgers',
            ),
            array(
                'stats_abbr' => 'det',
                'pfx_abbr' => 'detmlb',
                'league' => 'AL',
                'bbref' => 'DET',
                'location' => 'Detroit',
                'name' => 'Tigers',
            ),
            array(
                'stats_abbr' => 'hou',
                'pfx_abbr' => 'houmlb',
                'league' => 'AL',
                'bbref' => 'HOU',
                'location' => 'Houston',
                'name' => 'Astros',
            ),
            array(
                'stats_abbr' => 'kca',
                'pfx_abbr' => 'kcamlb',
                'league' => 'AL',
                'bbref' => 'KCR',
                'location' => 'Kansas City',
                'name' => 'Royals',
            ),
            array(
                'stats_abbr' => 'mia',
                'pfx_abbr' => 'miamlb',
                'league' => 'NL',
                'bbref' => 'MIA',
                'location' => 'Miami',
                'name' => 'Marlins',
            ),
            array(
                'stats_abbr' => 'mil',
                'pfx_abbr' => 'milmlb',
                'league' => 'NL',
                'bbref' => 'MIL',
                'location' => 'Milwaukee',
                'name' => 'Brewers',
            ),
            array(
                'stats_abbr' => 'nyn',
                'pfx_abbr' => 'nynmlb',
                'league' => 'NL',
                'bbref' => 'NYM',
                'location' => 'New York',
                'name' => 'Mets',
            ),
            array(
                'stats_abbr' => 'phi',
                'pfx_abbr' => 'phimlb',
                'league' => 'NL',
                'bbref' => 'PHI',
                'location' => 'Philadelphia',
                'name' => 'Phillies',
            ),
            array(
                'stats_abbr' => 'pit',
                'pfx_abbr' => 'pitmlb',
                'league' => 'NL',
                'bbref' => 'PIT',
                'location' => 'Pittsburgh',
                'name' => 'Pirates',
            ),
            array(
                'stats_abbr' => 'min',
                'pfx_abbr' => 'minmlb',
                'league' => 'AL',
                'bbref' => 'MIN',
                'location' => 'Minnesota',
                'name' => 'Twins',
            ),
            array(
                'stats_abbr' => 'nya',
                'pfx_abbr' => 'nyamlb',
                'league' => 'AL',
                'bbref' => 'NYY',
                'location' => 'New York',
                'name' => 'Yankees',
            ),
            array(
                'stats_abbr' => 'oak',
                'pfx_abbr' => 'oakmlb',
                'league' => 'AL',
                'bbref' => 'OAK',
                'location' => 'Oakland',
                'name' => 'Athletics',
            ),
            array(
                'stats_abbr' => 'sea',
                'pfx_abbr' => 'seamlb',
                'league' => 'AL',
                'bbref' => 'SEA',
                'location' => 'Seattle',
                'name' => 'Mariners',
            ),
            array(
                'stats_abbr' => 'sdn',
                'pfx_abbr' => 'sdnmlb',
                'league' => 'NL',
                'bbref' => 'SDP',
                'location' => 'San Diego',
                'name' => 'Padres',
            ),
            array(
                'stats_abbr' => 'tba',
                'pfx_abbr' => 'tbamlb',
                'league' => 'AL',
                'bbref' => 'TBR',
                'location' => 'Tampa Bay',
                'name' => 'Rays',
            ),
            array(
                'stats_abbr' => 'tex',
                'pfx_abbr' => 'texmlb',
                'league' => 'AL',
                'bbref' => 'TEX',
                'location' => 'Texas',
                'name' => 'Rangers',
            ),
            array(
                'stats_abbr' => 'tor',
                'pfx_abbr' => 'tormlb',
                'league' => 'AL',
                'bbref' => 'TOR',
                'location' => 'Toronto',
                'name' => 'Blue Jays',
            ),
            array(
                'stats_abbr' => 'sln',
                'pfx_abbr' => 'slnmlb',
                'league' => 'NL',
                'bbref' => 'STL',
                'location' => 'St. Louis',
                'name' => 'Cardinals',
            ),
            array(
                'stats_abbr' => 'was',
                'pfx_abbr' => 'wasmlb',
                'league' => 'NL',
                'bbref' => 'WSN',
                'location' => 'Washington',
                'name' => 'Nationals',
            ),
            array(
                'stats_abbr' => 'sfn',
                'pfx_abbr' => 'sfnmlb',
                'league' => 'NL',
                'bbref' => 'SFN',
                'location' => 'San Francisco',
                'name' => 'Giants',
            ),
        );
        
        foreach($leagues as $league){
            $l = League::where('name', $league)->first();
            if (!$l){
                $l = new League;
                $l->name = $league;
                $l->save();
            }
        }
        foreach($teams as $team){
            $t = Team::where('stats_abbr', $team['stats_abbr'])->first();
            if (!$t){
                $t = new Team;
                $t->stats_abbr = $team['stats_abbr'];
                $t->pfx_abbr = $team['pfx_abbr'];
                $l = League::where('name', $team['league'])->first();
                $t->league_id = $l->id;
                $t->location = $team['location'];
                $t->name = $team['name'];
            }
            $t->bbref = $team['bbref'];
            $t->save();
        }
    }
}