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

Route::prefix('categories')->middleware('checkLogin')->group(function() {
    Route::get('/', [
        'as' => 'categories.index',
        'uses' => 'CategoriesController@index',
    ]);
    Route::get('/create', [
        'as' => 'categories.create',
        'uses' => 'CategoriesController@create',
    ]);
    Route::post('/store', [
        'as' => 'categories.store',
        'uses' => 'CategoriesController@store',
    ]);
    Route::get('/edit/{id}', [
        'as' => 'categories.edit',
        'uses' => 'CategoriesController@edit',
    ]);
    Route::post('/update/{id}', [
        'as' => 'categories.update',
        'uses' => 'CategoriesController@update',
    ]);
    Route::get('/destroy/{id}', [
        'as' => 'categories.destroy',
        'uses' => 'CategoriesController@destroy',
    ]);
    
});