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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//User
Route::get('/user/profile', 'UserController@show')->name('user.profile');
Route::get('/user/avatar/{filename}', 'UserController@getImage')->name('user.avatar');
Route::get('/user/configuration', 'UserController@config')->name('config');
Route::post('/user/configuration-save', 'UserController@update')->name('user.save');
Route::get('/user/profile-image', 'UserController@profile_img')->name('user.img_profile');
Route::post('/user/profile-image/save', 'UserController@save_img')->name('user.save_img');
Route::get('/upload-image', 'ImageController@create')->name('image.create');
Route::post('/image/save', 'ImageController@save')->name('image.save');
Route::get('/image/file/{filename}', 'ImageController@getImage')->name('image.file');
