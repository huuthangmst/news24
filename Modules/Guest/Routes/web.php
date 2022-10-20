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

Route::prefix('guest')->middleware('checkLogin')->group(function() {
    Route::get('/', [
        'as' => 'guest.index',
        'uses' => 'GuestController@index',
    ]);
    Route::get('/list_check', [
        'as' => 'guest.list_check',
        'uses' => 'GuestController@list_check',
    ]);
});
