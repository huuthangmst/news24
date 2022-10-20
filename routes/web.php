<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

//Route::get('/auth', "App\Http\Controllers\AuthController@auth");
Auth::routes();

// Route::get('/', function () {
//     return view('home');
// });
// Route::get('/news', function () {
//     return view('news');
// });

Route::prefix('/auth')->group(function () {

    // CATEGORIES ROUTE
    Route::prefix('categories')->group(function () {
    });

    // TOPICS ROUTE
    Route::prefix('topics')->group(function () {
    });

    // POSTS ROUTE
    Route::prefix('posts')->group(function () {
    });

    // NEWS ROUTE
    Route::prefix('')->group(function () {
    });

    // HOME ROUTE
    Route::prefix('dashboard')->group(function () {
    });

    // ROUTE guest
    Route::prefix('guest')->group(function () {
    });
});



//Route::get('/news', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
