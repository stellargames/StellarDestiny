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

/**
 * API
 */
Route::group([
  'prefix'    => 'api/v1',
  'namespace' => 'Api',
], function () {
    $this->post('login', 'ApiAuthController@login');

    Route::group(['middleware' => ['api', 'auth:api']], function () {
        Route::get('logout', 'ApiAuthController@logout');
        Route::post('command', 'ApiController@request');
    });
});

/**
 * Client
 */
Route::group([
  'prefix'     => 'client',
  'namespace'  => 'Client',
  'middleware' => ['web', 'auth', 'role:Registered'],
], function () {
    Route::get('navigation', 'NavigationController@index');
    Route::post('navigation', 'NavigationController@jump');
    Route::get('inventory', 'ClientController@inventory');
    Route::get('trade', 'ClientController@trade');
    Route::get('info', 'InfoController@index');
    Route::get('comms', 'ClientController@comms');
});

/**
 * Portal
 */
Route::group(['namespace' => 'Portal', 'middleware' => ['web']], function () {
//  Homepage...
    Route::get('/', function () {
        return View::make('home');
    });

// Authentication routes...
    Route::get('auth/login', 'AuthController@getLogin');
    Route::post('auth/login', 'AuthController@postLogin');
    Route::get('auth/logout', 'AuthController@getLogout');

// Registration routes...
    Route::get('auth/register', 'AuthController@getRegister');
    Route::post('auth/register', 'AuthController@postRegister');

// Password reset link request routes...
    Route::get('password/email', 'PasswordController@getEmail');
    Route::post('password/email', 'PasswordController@postEmail');

// Password reset routes...
    Route::get('password/reset/{token}', 'PasswordController@getReset');
    Route::post('password/reset', 'PasswordController@postReset');
});

/**
 * Administration
 */
Route::group([
  'prefix'     => 'admin',
  'namespace'  => 'Admin',
  'middleware' => ['web', 'auth', 'role:Admin'],
], function () {
    // User management.
    Route::get('user', 'UserController@index');
    Route::any('user/edit', 'UserController@edit');

    // Item management.
    Route::get('item', 'ItemController@index');
    Route::any('item/edit', 'ItemController@edit');

    // Star maps.
    Route::get('star', 'StarController@index');
    Route::get('star/generate', 'StarController@getGenerate');
    Route::post('star/generate', 'StarController@postGenerate');

    Route::resource('ship', 'ShipController');
    Route::resource('trader', 'TraderController');

    Route::resource('shiptype', 'ShipTypeController');
    Route::resource('mine', 'MineController');
    Route::resource('faction', 'FactionController');
});

Route::post('deploy', function () {
    $payload = json_decode(Input::get('payload'));
    if ($payload->status_message === 'Passed') {
        touch(storage_path('app/deploy'));
    }
});
