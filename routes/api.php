<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');


    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
        //Barber
        Route::post('barbers/store', 'BarberController@store');
        Route::post('barbers/update', 'BarberController@update');
        Route::get('barbers/', 'BarberController@showAllBarbers');
        Route::get('barbers/{id}', 'BarberController@show');
        //Products
        Route::get('/products/{id}', 'ProductController@show');
        Route::get('/products/all/{id}', 'ProductController@showAllProducts');
        Route::post('/products/store', 'ProductController@store');
        Route::post('/products/update', 'ProductController@update');
        Route::delete('/products/delete/{id}', 'ProductController@destroy');

    });

    Route::get('users/data','UserController@show');//Show a User



});
