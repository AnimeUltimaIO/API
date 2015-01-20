<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});



/**
* GLOBAL PATTERNS
*/

Route::pattern('anime_id', '[0-9]+');
Route::pattern('api_key', '[a-zA-Z0-9-_]+');
Route::pattern('episode_num', '[0-9\.-]+');
Route::pattern('video_id', '[0-9]+');

/**
* ANIME API
*/
Route::get('/anime/list/{api_key}', [

	'before'	=>		'validAPIKey',
	'uses'		=>		'AnimeController@index',
	'as'		=>		'anime/index'

]);
