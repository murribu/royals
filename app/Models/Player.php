<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model {
	protected $table = 'players';
    
    public static function first_or_create_from_id_and_name($id, $name){
        $p = Player::where('mlb_id', $id)->first();
        if (!$p){
            $p = new Player;
            $p->mlb_id = $id;
            $p->first_name = substr($name, strpos($name,',') + 2);
            $p->last_name = substr($name, 0, strpos($name,','));
            $p->save();
        }
        
        return $p;
    }
}