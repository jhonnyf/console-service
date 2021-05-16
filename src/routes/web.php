<?php

use Illuminate\Support\Facades\Route;
use SenventhCode\ConsoleService\App\Http\Controllers\DashboardController;
use SenventhCode\ConsoleService\App\Http\Controllers\LoginController;
use SenventhCode\ConsoleService\App\Http\Controllers\UsersController;

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
    Route::get('', [LoginController::class, 'index'])->name('login.index');
    Route::post('authenticate', [LoginController::class, 'authenticate'])->name('login.authenticate');
    Route::get('logout', [LoginController::class, 'logout'])->name('login.logout');
});

Route::group(['middleware' => 'auth', 'prefix' => 'console'], function () {
    Route::get('', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'user'], function () {

        Route::group(['prefix' => 'category'], function () {
            Route::get('{id}', [UsersController::class, 'category'])->name('users.category');
            Route::post('{id}', [UsersController::class, 'categoryStore'])->name('users.category-store');
        });

        Route::group(['prefix' => 'password'], function () {
            Route::get('{id}', [UsersController::class, 'password'])->name('users.password');
            Route::post('{id}', [UsersController::class, 'passwordStore'])->name('users.password-store');
        });

        Route::get('', [UsersController::class, 'index'])->name('users.index');
        Route::get('form/{id?}', [UsersController::class, 'form'])->name('users.form');
        Route::post('form', [UsersController::class, 'store'])->name('users.store');
        Route::put('form/{id}', [UsersController::class, 'update'])->name('users.update');
        Route::get('active/{id}', [UsersController::class, 'active'])->name('users.active');
        Route::get('destroy/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
    });
});
