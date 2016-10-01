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
                'location' => 'Los Angeles',
                'name' => 'Angels',
            ),
            array(
                'stats_abbr' => 'ari',
                'pfx_abbr' => 'arimlb',
                'league' => 'NL',
                'location' => 'Arizona',
                'name' => 'Diamondbacks',
            ),
            array(
                'stats_abbr' => 'cha',
                'pfx_abbr' => 'chamlb',
                'league' => 'AL',
                'location' => 'Chicago',
                'name' => 'White Sox',
            ),
            array(
                'stats_abbr' => 'cin',
                'pfx_abbr' => 'cinmlb',
                'league' => 'NL',
                'location' => 'Cincinnati',
                'name' => 'Reds',
            ),
            array(
                'stats_abbr' => 'col',
                'pfx_abbr' => 'colmlb',
                'league' => 'NL',
                'location' => 'Colorado',
                'name' => 'Rockies',
            ),
            array(
                'stats_abbr' => 'det',
                'pfx_abbr' => 'detmlb',
                'league' => 'AL',
                'location' => 'Detroit',
                'name' => 'Tigers',
            ),
            array(
                'stats_abbr' => 'mil',
                'pfx_abbr' => 'milmlb',
                'league' => 'NL',
                'location' => 'Milwaukee',
                'name' => 'Brewers',
            ),
            array(
                'stats_abbr' => 'nya',
                'pfx_abbr' => 'nyamlb',
                'league' => 'AL',
                'location' => 'New York',
                'name' => 'Yankees',
            ),
            array(
                'stats_abbr' => 'oak',
                'pfx_abbr' => 'oakmlb',
                'league' => 'AL',
                'location' => 'Oakland',
                'name' => 'Athletics',
            ),
            array(
                'stats_abbr' => 'phi',
                'pfx_abbr' => 'phimlb',
                'league' => 'NL',
                'location' => 'Philadelphia',
                'name' => 'Phillies',
            ),
            array(
                'stats_abbr' => 'pit',
                'pfx_abbr' => 'pitmlb',
                'league' => 'NL',
                'location' => 'Pittsburgh',
                'name' => 'Pirates',
            ),
            array(
                'stats_abbr' => 'sea',
                'pfx_abbr' => 'seamlb',
                'league' => 'AL',
                'location' => 'Seattle',
                'name' => 'Mariners',
            ),
            array(
                'stats_abbr' => 'tba',
                'pfx_abbr' => 'tbamlb',
                'league' => 'AL',
                'location' => 'Tampa Bay',
                'name' => 'Rays',
            ),
            array(
                'stats_abbr' => 'tor',
                'pfx_abbr' => 'tormlb',
                'league' => 'AL',
                'location' => 'Toronto',
                'name' => 'Blue Jays',
            ),
            array(
                'stats_abbr' => 'was',
                'pfx_abbr' => 'wasmlb',
                'league' => 'NL',
                'location' => 'Washington',
                'name' => 'Nationals',
            ),
            array(
                'stats_abbr' => 'chn',
                'pfx_abbr' => 'chnmlb',
                'league' => 'NL',
                'location' => 'Chicago',
                'name' => 'Cubs',
            ),
            array(
                'stats_abbr' => 'lan',
                'pfx_abbr' => 'lanmlb',
                'league' => 'NL',
                'location' => 'Los Angeles',
                'name' => 'Dodgers',
            ),
            array(
                'stats_abbr' => 'mia',
                'pfx_abbr' => 'miamlb',
                'league' => 'NL',
                'location' => 'Miami',
                'name' => 'Marlins',
            ),
            array(
                'stats_abbr' => 'sdn',
                'pfx_abbr' => 'sdnmlb',
                'league' => 'NL',
                'location' => 'San Diego',
                'name' => 'Padres',
            ),
            array(
                'stats_abbr' => 'tex',
                'pfx_abbr' => 'texmlb',
                'league' => 'AL',
                'location' => 'Texas',
                'name' => 'Rangers',
            ),
            array(
                'stats_abbr' => 'bal',
                'pfx_abbr' => 'balmlb',
                'league' => 'AL',
                'location' => 'Baltimore',
                'name' => 'Orioles',
            ),
            array(
                'stats_abbr' => 'cle',
                'pfx_abbr' => 'clemlb',
                'league' => 'AL',
                'location' => 'Cleveland',
                'name' => 'Indians',
            ),
            array(
                'stats_abbr' => 'hou',
                'pfx_abbr' => 'houmlb',
                'league' => 'AL',
                'location' => 'Houston',
                'name' => 'Astros',
            ),
            array(
                'stats_abbr' => 'atl',
                'pfx_abbr' => 'atlmlb',
                'league' => 'NL',
                'location' => 'Atlanta',
                'name' => 'Braves',
            ),
            array(
                'stats_abbr' => 'bos',
                'pfx_abbr' => 'bosmlb',
                'league' => 'AL',
                'location' => 'Boston',
                'name' => 'Red Sox',
            ),
            array(
                'stats_abbr' => 'kca',
                'pfx_abbr' => 'kcamlb',
                'league' => 'AL',
                'location' => 'Kansas City',
                'name' => 'Royals',
            ),
            array(
                'stats_abbr' => 'min',
                'pfx_abbr' => 'minmlb',
                'league' => 'AL',
                'location' => 'Minnesota',
                'name' => 'Twins',
            ),
            array(
                'stats_abbr' => 'nyn',
                'pfx_abbr' => 'nynmlb',
                'league' => 'NL',
                'location' => 'New York',
                'name' => 'Mets',
            ),
            array(
                'stats_abbr' => 'sln',
                'pfx_abbr' => 'slnmlb',
                'league' => 'NL',
                'location' => 'St. Louis',
                'name' => 'Cardinals',
            ),
            array(
                'stats_abbr' => 'sfn',
                'pfx_abbr' => 'sfnmlb',
                'league' => 'NL',
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
                $t->save();
            }
        }
    }
}