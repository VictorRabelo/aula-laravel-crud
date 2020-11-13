<?php

use Illuminate\Http\Request;
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

Route::group(['prefix' =>'/v1'], function() {

    Route::group(['prefix' =>'/users'], function() {
        
        // C - CREATE
        Route::post('/', 'CrudController@store');

        // R - READ
        Route::get('/', 'CrudController@index');
        
        Route::get('/{id}', 'CrudController@show');
        
        // U - UPDATE
        Route::put('/{id}', 'CrudController@update');

        // D - DELETE
        Route::delete('/{id}', 'CrudController@destroy');

    });
    

});
