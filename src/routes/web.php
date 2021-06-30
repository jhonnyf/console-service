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

Route::group(['prefix' => 'console'], function () {
    Route::get('login', [LoginController::class, 'index'])->name('login.index');
    Route::get('logout', [LoginController::class, 'logout'])->name('login.logout');
    Route::get('starter', [LoginController::class, 'starter'])->name('login.starter');
    Route::post('authenticate', [LoginController::class, 'authenticate'])->name('login.authenticate');
});

Route::group(['middleware' => 'auth', 'prefix' => 'console'], function () {
    Route::get('', [DashboardController::class, 'index'])->name('dashboard');
});
