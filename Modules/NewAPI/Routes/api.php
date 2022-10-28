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

Route::middleware('auth:api')->get('/newapi', function (Request $request) {
    return $request->user();
});

// POST
Route::get('/newposts', [
    'as' => 'newposts.getData',
    'uses' => 'NewAPIController@getData',
]);
Route::post('/createpost', [
    'as' => 'createpost.createPost',
    'uses' => 'NewAPIController@createPost',
]);
Route::post('/updatepost/{id}', [
    'as' => 'updateposts.updatePost',
    'uses' => 'NewAPIController@updatePost',
]);
Route::delete('/deletepost/{id}', [
    'as' => 'deletepost.deletePost',
    'uses' => 'NewAPIController@deletePost',
]);

// CATEGORIES
Route::get('/getcategories', [
    'as' => 'getcategories.getCategories',
    'uses' => 'NewAPIController@getCategories',
]);
// TOPICS
Route::get('/gettopics', [
    'as' => 'gettopics.getTopics',
    'uses' => 'NewAPIController@getTopics',
]);