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
//Publics
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home/search', 'HomeController@search')->name('search');

//User
Route::get('/user/profile', 'UserController@show')->name('user.profile');
Route::get('/user/avatar/{filename}', 'UserController@getImage')->name('user.avatar');
Route::get('/user/configuration', 'UserController@config')->name('config');
Route::post('/user/configuration-save', 'UserController@update')->name('user.save');
Route::get('/user/profile-image', 'UserController@profile_img')->name('user.img_profile');
Route::post('/user/profile-image/save', 'UserController@save_img')->name('user.save_img');
//BARBERS
Route::get('/user/barber/create', 'UserController@createBarber')->name('barber.create');
Route::get('/user/barber/edit', 'UserController@editBarber')->name('barber.edit');
Route::get('/user/barber/show', 'UserController@showMyBarber');
Route::get('/user/barber/turns', 'BarberController@showTurns')->name('barber.turns');
Route::get('/user/barber/avatar/{filename}', 'BarberController@getImage')->name('barber.avatar');
Route::post('/user/barber/store', 'BarberController@store')->name('barber.store');
Route::post('/user/barber/update', 'BarberController@update')->name('barber.update');
Route::get('/barber/show/{id}', 'BarberController@showBarber');

/*
//Turns
Route::get('/user/turns', 'UserController@showTurns')->name('user.turns');
Route::get('/user/turn/create/{id}', 'TurnController@create');
Route::post('/user/turn/save/{id}', 'TurnController@save');
Route::delete('/user/turn/delete/{id}', 'TurnController@destroy');

//Products
Route::get('/barber/products/{id}', 'ProductController@showProducts');
Route::get('/barber/product/edit/{id}', 'ProductController@editProduct');
Route::get('/barber/product/create', 'ProductController@addProduct')->name('product.create');
Route::get('/barber/product/avatar/{filename}', 'ProductController@getImage')->name('product.avatar');
Route::post('/barber/product/new', 'ProductController@newProduct')->name('product.new');
Route::post('/barber/product/upddate/{id}', 'ProductController@updateProduct');
Route::delete('/barber/product/delete/{id}', 'ProductController@destroy');

//Images
Route::get('/upload-image', 'ImageController@create')->name('image.create');
Route::post('/image/save', 'ImageController@save')->name('image.save');
Route::get('/image/file/{filename}', 'ImageController@getImage')->name('image.file');
*/
