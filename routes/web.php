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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function() {
        return view('home');
    })->name('home');

    Route::get('/account', function() {
        return view('account');
    })->name('account');

    Route::get('/pages/{pageId}/posts/{postId}', 'PostController@view')->name('post.show');

    Route::get('/pages/{id}', 'PageController@view')->name('page.show');

    Route::resource('page', 'PageController');
});