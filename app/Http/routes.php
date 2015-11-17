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
	return View::make('web');
});

/**
 * Authentication
 */
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

/**
 * Administration
 */
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth:admin'], function() {
	Route::resource('player', 'PlayerController');
	Route::resource('ship', 'ShipController');
	Route::resource('trader', 'TraderController');
	Route::resource('star', 'StarController');
	Route::resource('item', 'ItemController');
	Route::resource('itemtype', 'ItemTypeController');
	Route::resource('starlink', 'StarLinkController');
	Route::resource('shiptype', 'ShipTypeController');
	Route::resource('mine', 'MineController');
	Route::resource('faction', 'FactionController');
});
