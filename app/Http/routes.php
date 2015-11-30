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

Route::get('/', function () {
    return View::make('home');
});

/**
 * Authentication
 */
// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

/**
 * Administration
 */
Route::group([ 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth:admin' ], function () {
    // User management.
    Route::get('user', 'UserController@index');
    Route::any('user/edit', 'UserController@edit');

    // Star maps.
    Route::get('star', 'StarController@index');
    Route::get('star/generate', 'StarController@generate');

    Route::resource('ship', 'ShipController');
    Route::resource('trader', 'TraderController');

    Route::resource('item', 'ItemController');
    Route::resource('itemtype', 'ItemTypeController');
    Route::resource('shiptype', 'ShipTypeController');
    Route::resource('mine', 'MineController');
    Route::resource('faction', 'FactionController');
});

Route::post('deploy', function () {
    $payload = json_decode(Input::get('payload'));
    if ($payload->status_message == 'Passed') {
        touch(storage_path('app/deploy'));
    }
});
