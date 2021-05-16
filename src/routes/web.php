<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'login'], function () {
    Route::get('', 'loginController@index')->name('login.index');
    Route::post('authenticate', 'loginController@authenticate')->name('login.authenticate');
    Route::get('logout', 'LoginController@logout')->name('login.logout');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('', 'DashboardController@index')->name('dashboard');

    Route::group(['prefix' => 'user'], function () {

        Route::group(['prefix' => 'category'], function () {
            Route::get('{id}', 'UsersController@category')->name('users.category');
            Route::post('{id}', 'UsersController@categoryStore')->name('users.category-store');
        });

        Route::group(['prefix' => 'password'], function () {
            Route::get('{id}', 'UsersController@password')->name('users.password');
            Route::post('{id}', 'UsersController@passwordStore')->name('users.password-store');
        });

        Route::get('', 'UsersController@index')->name('users.index');
        Route::get('form/{id?}', 'UsersController@form')->name('users.form');
        Route::post('form', 'UsersController@store')->name('users.store');
        Route::put('form/{id}', 'UsersController@update')->name('users.update');
        Route::get('active/{id}', 'UsersController@active')->name('users.active');
        Route::get('destroy/{id}', 'UsersController@destroy')->name('users.destroy');
    });
});
