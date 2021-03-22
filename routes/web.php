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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function() {
    Route::get('news/create','Admin\NewsController@add');
    Route::get('profile/create','Admin\ProfileController@add'); //(PHP/Laravel 09 課題4)
    Route::get('profile/edit','Admin\ProfileController@edit'); //(PHP/Laravel 10 課題4)

});

Route::get('XXX','AAAController@bbb'); //課題3(PHP/Laravel 09 Routingについて理解する)