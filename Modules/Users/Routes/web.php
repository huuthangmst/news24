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

Route::prefix('users')->group(function() {
    Route::get('/', [
        'as' => 'users.index',
        'uses' => 'UsersController@index',
    ]);
    Route::get('/edit/{id}', [
        'as' => 'users.edit',
        'uses' => 'UsersController@edit',
    ]);
    Route::post('/update/{id}', [
        'as' => 'users.update',
        'uses' => 'UsersController@update',
    ]);
    Route::get('/destroy/{id}', [
        'as' => 'users.destroy',
        'uses' => 'UsersController@destroy',
    ]);
});
