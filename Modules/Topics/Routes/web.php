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

Route::prefix('topics')->middleware('checkLogin')->group(function () {
    Route::get('/', [
        'as' => 'topics.index',
        'uses' => 'TopicsController@index',
    ]);
    Route::get('/create', [
        'as' => 'topics.create',
        'uses' => 'TopicsController@create',
    ]);
    Route::post('/store', [
        'as' => 'topics.store',
        'uses' => 'TopicsController@store',
    ]);
    Route::get('/edit/{id}', [
        'as' => 'topics.edit',
        'uses' => 'TopicsController@edit',
    ]);
    Route::post('/update/{id}', [
        'as' => 'topics.update',
        'uses' => 'TopicsController@update',
    ]);
    Route::get('/destroy/{id}', [
        'as' => 'topics.destroy',
        'uses' => 'TopicsController@destroy',
    ]);
});
