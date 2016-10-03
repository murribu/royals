<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});

Route::group(['prefix' => 'api'], function(){
    Route::get('years', 'ApiController@getYears');
    Route::get('months/{year}', 'ApiController@getMonths');
    Route::get('days/{year}/{month}', 'ApiController@getDays');
    Route::get('games/{year}/{month}/{day}', 'ApiController@getGames');
    Route::get('game/{game_id}', 'ApiController@getGame');
    Route::get('game/{game_id}/inning/{inning}', 'ApiController@getInning');
    Route::get('game/{game_id}/pa/{pa}', 'ApiController@getPlateAppearance');
    
});
