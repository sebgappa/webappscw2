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

    Route::resource('post/{postId}/comment', 'CommentController');

    Route::resource('page/{pageId}/post', 'PostController');

    Route::resource('page', 'PageController');

    Route::get('pages/{pageId}/users', 'PageController@getPageUsers');

    Route::get('users/{id}/pages/member', 'UserController@memberPages');

    Route::get('users/{id}/pages/creator', 'UserController@createdPages');

    Route::get('users/{id}/posts', 'UserController@posts');

    Route::get('users/{id}/comments', 'UserController@comments');
});