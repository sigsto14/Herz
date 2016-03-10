<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');




// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::resource('user', 'UserController');
Route::resource('channel', 'ChannelController');
Route::resource('sound', 'SoundController');
Route::resource('favorite', 'FavoriteController');

Route::post('channel/edit', 'ChannelController@update');
Route::post('channel/create', 'ChannelController@create');
Route::post('user/edit', 'UserController@update');



Route::resource('/', 'IndexController');

Route::resource('channel', 'ChannelController');

Route::get('login', function () {
    return view('login');
});

Route::get('logout', function () {
    return back('index');
});


Route::get('register', function () {
    return view('register');
});


Route::get('home', function () {
    return view('index');
});


Route::get('channels/create', function () {
    return view('channels.create');
});

Route::get('sounds/create', function () {
    return view('sounds.create');
});


