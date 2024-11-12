<?php

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

use App\Http\Controllers\WordController;

Route::middleware('auth')->group(function(){
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/home', 'HomeController@index')->name('home');  

    //post
    Route::get('/post', 'PostController@index')->name('post.index');
    Route::get('/post/create', 'PostController@create')->name('post.create');
    Route::get('/post/{id}', 'PostController@detail')->name('post.detail');
    Route::post('/post', 'PostController@store')->name('post.store');

    // Route::get('/api/post', 'PostController@api')->name('post.api');

    //word
    Route::get('/word', 'WordController@index')->name('word.index');
    // Route::get('/word/create', 'WordController@create')->name('word.create');Ajaxの時は使わない
    Route::post('/word', 'WordController@store')->name('word.store');
    Route::get('/word/detail/{id}', 'WordController@detail')->name('word.detail');
    Route::put('/word/update/{id}', 'WordController@update')->name('word.update');
    Route::delete('/word/delete/{id}', 'WordController@delete')->name('word.delete');

});

Auth::routes();


