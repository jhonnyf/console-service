<?php

use Illuminate\Support\Facades\Route;
use SenventhCode\ConsoleService\App\Http\Controllers\DashboardController;
use SenventhCode\ConsoleService\App\Http\Controllers\FileController;
use SenventhCode\ConsoleService\App\Http\Controllers\LoginController;
use SenventhCode\ConsoleService\App\Http\Controllers\UserController;

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

Route::group(['middleware' => 'web', 'prefix' => 'console'], function () {

    Route::get('login', [LoginController::class, 'index'])->name('login.index');
    Route::get('logout', [LoginController::class, 'logout'])->name('login.logout');
    Route::post('authenticate', [LoginController::class, 'authenticate'])->name('login.authenticate');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('', function () {
            return redirect()->route('dashboard');
        });

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::group(['prefix' => 'user'], function () {

            Route::group(['prefix' => 'address'], function () {
                Route::get('{id}', [UserController::class, 'address'])->name('user.address');
                Route::post('store/{id}', [UserController::class, 'addressStore'])->name('user.address-store');
            });

            Route::group(['prefix' => 'category'], function () {
                Route::get('{id}', [UserController::class, 'category'])->name('user.category');
                Route::post('store/{id}', [UserController::class, 'categoryStore'])->name('user.category-store');
            });

            Route::group(['prefix' => 'password'], function () {
                Route::get('{id}', [UserController::class, 'password'])->name('user.password');
                Route::post('store/{id}', [UserController::class, 'passwordStore'])->name('user.password-store');
            });

            Route::get('', [UserController::class, 'index'])->name('user.index');
            Route::get('form/{id?}', [UserController::class, 'form'])->name('user.form');
            Route::post('form', [UserController::class, 'store'])->name('user.store');
            Route::put('form/{id}', [UserController::class, 'update'])->name('user.update');
            Route::get('active/{id}', [UserController::class, 'active'])->name('user.active');
            Route::get('destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
        });

        Route::group(['prefix' => 'category'], function () {
            Route::get('show/{id}', 'CategoriesController@show')->name('category.show');
            Route::post('structure', 'CategoriesController@structure')->name('category.structure');
            Route::get('form/{id?}', 'CategoriesController@form')->name('category.form');
            Route::get('active/{id}', 'CategoriesController@active')->name('category.active');
            Route::get('destroy/{id}', 'CategoriesController@destroy')->name('category.destroy');
            Route::get('', 'CategoriesController@index')->name('category.index');
            Route::post('', 'CategoriesController@store')->name('category.store');
            Route::put('{id}', 'CategoriesController@update')->name('category.update');

            Route::group(['prefix' => 'content'], function () {
                Route::get('{id}', 'CategoriesController@content')->name('category.content');
                Route::post('{id}', 'CategoriesController@contentUpdate')->name('category.content-update');
            });
        });

        Route::group(['prefix' => 'content'], function () {
            Route::get('form/{id?}', 'ContentsController@form')->name('content.form');
            Route::get('active/{id}', 'ContentsController@active')->name('content.active');
            Route::get('destroy/{id}', 'ContentsController@destroy')->name('content.destroy');
            Route::get('', 'ContentsController@index')->name('content.index');
            Route::post('', 'ContentsController@store')->name('content.store');
            Route::put('{id}', 'ContentsController@update')->name('content.update');
        });

        Route::group(['prefix' => 'language'], function () {
            Route::get('', 'LanguagesController@index')->name('language.index');
            Route::get('form/{id?}', 'LanguagesController@form')->name('language.form');
            Route::post('form', 'LanguagesController@store')->name('language.store');
            Route::put('form/{id}', 'LanguagesController@update')->name('language.update');
            Route::get('active/{id}', 'LanguagesController@active')->name('language.active');
            Route::get('destroy/{id}', 'LanguagesController@destroy')->name('language.destroy');
        });

        Route::group(['prefix' => 'file-gallery'], function () {
            Route::get('', 'FilesGalleriesController@index')->name('file-gallery.index');
            Route::get('form/{id?}', 'FilesGalleriesController@form')->name('file-gallery.form');
            Route::post('form', 'FilesGalleriesController@store')->name('file-gallery.store');
            Route::put('form/{id}', 'FilesGalleriesController@update')->name('file-gallery.update');
            Route::get('active/{id}', 'FilesGalleriesController@active')->name('file-gallery.active');
            Route::get('destroy/{id}', 'FilesGalleriesController@destroy')->name('file-gallery.destroy');
        });

        Route::group(['prefix' => 'file'], function () {

            Route::get('form/{id}', [FileController::class, 'form'])->name('file.form');
            Route::post('update/{id}', [FileController::class, 'update'])->name('file.update');
            Route::get('active/{id}', [FileController::class, 'active'])->name('file.active');
            Route::get('destroy/{id}', [FileController::class, 'destroy'])->name('file.destroy');

            Route::post('submit/{module}/{link_id}/{file_gallery_id}', [FileController::class, 'submitFiles'])->name('file.upload-submit');

            Route::get('{module}/{link_id}', [FileController::class, 'listGalleries'])->name('file.list-galleries');

        });
    });

});
