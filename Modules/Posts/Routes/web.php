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

Route::prefix('posts')->middleware('checkLogin')->group(function() {
    Route::get('/', [
        'as' => 'posts.index',
        'uses' => 'PostsController@index',
    ]);
    Route::get('/create', [
        'as' => 'posts.create',
        'uses' => 'PostsController@create',
    ]);
    Route::post('/store', [
        'as' => 'posts.store',
        'uses' => 'PostsController@store',
    ]);
    Route::get('/edit/{id}', [
        'as' => 'posts.edit',
        'uses' => 'PostsController@edit',
    ]);
    Route::post('/update/{id}', [
        'as' => 'posts.update',
        'uses' => 'PostsController@update',
    ]);
    Route::get('/destroy/{id}', [
        'as' => 'posts.destroy',
        'uses' => 'PostsController@destroy',
    ]);
    Route::get('/get_api', [
        'as' => 'posts.getApi',
        'uses' => 'PostsController@getApi',
    ]);
    Route::get('/check/{id}', [
        'as' => 'posts.check',
        'uses' => 'PostsController@check',
    ]);
    Route::post('/checked/{id}', [
        'as' => 'posts.checked',
        'uses' => 'PostsController@checked',
    ]);
});
