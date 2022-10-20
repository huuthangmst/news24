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

Route::prefix('/')->group(function() {
    Route::get('/', [
        'as' => 'news.index',
        'uses' => 'NewsController@index',
    ]);
    Route::get('detail/{slug}', [
        'as' => 'news.detail',
        'uses' => 'NewsController@detail',
    ]);
    Route::get('categories/{slug}', [
        'as' => 'news.categories',
        'uses' => 'NewsController@categories',
    ]);
    Route::get('topic/{slug}', [
        'as' => 'news.topics',
        'uses' => 'NewsController@topic',
    ]);
    Route::post('comment', [
        'as' => 'news.comment',
        'uses' => 'NewsController@comment',
    ]);
    Route::post('reply/{id}', [
        'as' => 'news.reply',
        'uses' => 'NewsController@reply',
    ]);
});
