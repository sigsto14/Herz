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
Route::get('search/index', 'QueryController@search');
Route::post('search/index', 'QueryController@search');

Route::resource('user', 'UserController');

Route::resource('channel', 'ChannelController');
Route::resource('resetPassword', 'resetpasswordController@index');
Route::resource('resetPassword/reset', 'resetpasswordController@reset');
Route::resource('sound', 'SoundController');
Route::resource('favorite', 'FavoriteController');
Route::resource('category', 'CategoryController');
Route::resource('query', 'QueryController');
Route::resource('subscribe', 'SubscribeController');
Route::resource('notification', 'NotificationController');
Route::resource('playlist', 'PlaylistController');
Route::resource('exist', 'PlaylistController@exists');
Route::resource('playlist/edit', 'PlaylistController@update');
Route::resource('playlist/show', 'PlaylistController@show');
Route::resource('playlist/redigera', 'PlaylistController@redigera');
Route::resource('playlist/taBort', 'PlaylistController@taBort');

Route::post('playlist/create', 'PlaylistController@create');
Route::post('channel/edit', 'ChannelController@update');
Route::post('channel/create', 'ChannelController@create');
Route::post('user/edit', 'UserController@update');
Route::post('category/show', 'CategoryController@show');
Route::post('noty', 'NotificationController@index');
Route::resource('comment', 'CommentController');	


Route::get('favorite/destroy', 'FavoriteController@destroy');



Route::resource('/', 'IndexController');

Route::resource('channel', 'ChannelController');

Route::get('login', function () {
    return view('login');
});


Route::get('playlist', function () {
    return view('playlist.index');
});

Route::get('back', function () {
    return back();
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

Route::get('favorite', function () {
    return view('favorites.index');
});


Route::get('channels/create', function () {
    return view('channels.create');
});

Route::get('sounds/create', function () {
    return view('sounds.create');
});

Route::get('noty', function () {
    return response()->json(['html' => $html]);
});


