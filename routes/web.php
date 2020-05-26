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
Route::get('/user/configuration', 'UserController@config')->name('config');
Route::get('/user/profile', 'UserController@show')->name('profile');
Route::get('/user/avatar/{filename}', 'UserController@getImage')->name('user.avatar');
Route::get('/user/upload_img', 'UserController@profile_img')->name('user.image_profile');
Route::post('/user/image/save', 'UserController@save_img')->name('user.save_img');
Route::post('/user/edit','UserController@update');
Route::get('/user/barber/create', 'UserController@createBarber')->name('barber.create');
Route::get('/user/barber/show', 'UserController@showBarber')->name('barber.show');
Route::get('/user/barber/edit', 'UserController@editBarber')->name('barber.edit');
//Barber
Route::post('/user/barber/new', 'BarberController@create')->name('barber.new');
