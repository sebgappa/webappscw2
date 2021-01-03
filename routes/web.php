<?php

use Illuminate\Support\Facades\Route;
use App\Dogs;

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

app()->singleton(Dogs::class, function ($app) {
    return new Dogs();
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function() {
        return view('home');
    })->name('home');

    Route::get('/account', 'AccountController@view')->name('account');

    Route::get('page/create', 'PageController@create');

    Route::get('/page/{pageId}/post/create', 'PostController@create');

    Route::get('/page/{pageId}/post/{postId}', 'PostController@view')->name('post.show');

    Route::get('/page/{id}', 'PageController@view')->name('page.show');
});