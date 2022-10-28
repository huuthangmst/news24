<?php
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('newapi')->group(function() {
    Route::get('/', [
        'as' => 'newapi.index',
        'uses' => 'NewAPIController@index',
    ]);
    Route::get('/create', [
        'as' => 'newapi.create',
        'uses' => 'NewAPIController@create',
    ]);
    Route::post('/store', [
        'as' => 'newapi.store',
        'uses' => 'NewAPIController@store',
    ]);
    Route::get('/destroy/{id}', [
        'as' => 'newapi.destroy',
        'uses' => 'NewAPIController@destroy',
    ]);
    Route::get('/edit/{id}', [
        'as' => 'newapi.edit',
        'uses' => 'NewAPIController@edit',
    ]);
    Route::post('/update/{id}', [
        'as' => 'newapi.update',
        'uses' => 'NewAPIController@update',
    ]);
});
