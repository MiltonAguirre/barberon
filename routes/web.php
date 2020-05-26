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
Route::get('/user/configuracion', 'UserController@config')->name('config');
Route::get('/user/mi-perfil', 'UserController@show')->name('profile');
Route::post('/user/edit/{id}','UserController@update');
