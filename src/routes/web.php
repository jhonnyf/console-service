<?php

use Illuminate\Support\Facades\Route;
use SenventhCode\ConsoleService\App\Http\Controllers\DashboardController;
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

Route::group(['middleware' => 'web'], function () {

    Route::group(['prefix' => 'console'], function () {
        Route::get('login', [LoginController::class, 'index'])->name('login.index');
        Route::get('logout', [LoginController::class, 'logout'])->name('login.logout');
        Route::post('authenticate', [LoginController::class, 'authenticate'])->name('login.authenticate');
    });

    Route::group(['middleware' => 'auth', 'prefix' => 'console'], function () {
        Route::get('', function () {
            return redirect()->route('dashboard');
        });

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });

    Route::group(['prefix' => 'user'], function () {

        Route::group(['prefix' => 'category'], function () {
            Route::get('{id}', [UserController::class, 'category'])->name('user.category');
            Route::post('{id}', [UserController::class, 'categoryStore'])->name('user.category-store');
        });

        Route::group(['prefix' => 'password'], function () {
            Route::get('{id}', [UserController::class, 'password'])->name('user.password');
            Route::post('{id}', [UserController::class, 'passwordStore'])->name('user.password-store');
        });

        Route::get('', [UserController::class, 'index'])->name('user.index');
        Route::get('form/{id?}', [UserController::class, 'form'])->name('user.form');
        Route::post('form', [UserController::class, 'store'])->name('user.store');
        Route::put('form/{id}', [UserController::class, 'update'])->name('user.update');
        Route::get('active/{id}', [UserController::class, 'active'])->name('user.active');
        Route::get('destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    });

});
