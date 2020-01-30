<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/login', 'UserController@apiLogin');

Route::group(['middleware' => ['checktoken'] ], function() {
    Route::get('/user', 'UserController@apiUser');

    // Shortlinks
    Route::get('/shortlinks', 'ShortlinkController@apiShortlinks');
    Route::post('/shortlinks', 'ShortlinkController@apiCreateShortlink');
    Route::delete('/shortlinks/{id}', 'ShortlinkController@apideactivateShortlink');
});