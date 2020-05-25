<?php

use Illuminate\Support\Facades\Route;

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

Route::prefix('stats')->name('stats.')->group(function () {
    Route::get('/players', 'PlayerStatsController@index')->name('players.index');
    Route::get('/players/{id}', 'PlayerStatsController@show')->name('players.show');
});
