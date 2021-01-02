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

Route::middleware(['auth:api'])->group(function() {
    Route::get('/user', function(Request $request) {
        return $request->user();
    });

    Route::get('page/{pageId}/user', 'PageController@getPageUsers');

    Route::get('user/{id}/page/member', 'UserController@memberPages');

    Route::get('user/{id}/page/creator', 'UserController@createdPages');

    Route::get('user/{id}/post', 'UserController@posts');

    Route::get('user/{id}/comment', 'UserController@comments');

    Route::resource('post/{postId}/comment', 'CommentController');

    Route::resource('page/{pageId}/post', 'PostController');

    Route::resource('page', 'PageController');
});