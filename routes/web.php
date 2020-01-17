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

Route::get('/', 'VoteController@active')->name('welcome');

Route::post('/vote', 'VoteController@update');

Route::get('/vote/create', 'VoteController@create');

Route::get('/vote/{vote}', 'VoteController@show')->name('show');

Route::post('/vote/edit', 'VoteController@edit');

Route::post('/vote/delete', 'VoteController@destroy');

Auth::routes();

Route::post('/home', 'VoteController@store');

Route::get('/home', 'VoteController@index')->name('home');
