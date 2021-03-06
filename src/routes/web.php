<?php

use Illuminate\Support\Facades\Route;
use SenventhCode\ConsoleService\App\Http\Controllers\CategoryController;
use SenventhCode\ConsoleService\App\Http\Controllers\ContentsController;
use SenventhCode\ConsoleService\App\Http\Controllers\DashboardController;
use SenventhCode\ConsoleService\App\Http\Controllers\FileController;
use SenventhCode\ConsoleService\App\Http\Controllers\FileGalleryController;
use SenventhCode\ConsoleService\App\Http\Controllers\LanguageController;
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

    Route::group(['middleware' => 'auth:console-service'], function () {
        Route::get('', function () {
            return redirect()->route('dashboard');
        });

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('color-scheme/{scheme}', [DashboardController::class, 'colorScheme'])->name('color-scheme');

        Route::group(['prefix' => 'user'], function () {

            Route::group(["prefix" => 'extension'], function () {
                Route::get('{id}', [UserController::class, 'extension'])->name('user.extension');
                Route::post('update/{id}', [UserController::class, 'extensionUpdate'])->name('user.extension-update');
            });

            Route::group(['prefix' => 'address'], function () {
                Route::get('{id}/{address_id?}', [UserController::class, 'address'])->name('user.address');
                Route::post('store/{id}', [UserController::class, 'addressStore'])->name('user.address-store');
                Route::post('update/{id}', [UserController::class, 'addressUpdate'])->name('user.address-update');
                Route::get('destroy/{id}/{address_id}', [UserController::class, 'addressDestroy'])->name('user.address-destroy');
            });

            Route::group(['prefix' => 'category'], function () {
                Route::get('{id}', [UserController::class, 'category'])->name('user.category');
                Route::post('store/{id}', [UserController::class, 'categoryStore'])->name('user.category-store');
            });

            Route::group(['prefix' => 'password'], function () {
                Route::get('{id}', [UserController::class, 'password'])->name('user.password');
                Route::post('store/{id}', [UserController::class, 'passwordStore'])->name('user.password-store');
            });

            Route::get('export', [UserController::class, 'export'])->name('user.export');
            Route::get('download/{file_gallery_id}', [UserController::class, 'download'])->name('user.download');
            Route::get('list/{category_id}', [UserController::class, 'index'])->name('user.index');
            Route::get('form/{id?}', [UserController::class, 'form'])->name('user.form');
            Route::post('form', [UserController::class, 'store'])->name('user.store');
            Route::put('form/{id}', [UserController::class, 'update'])->name('user.update');
            Route::get('active/{id}', [UserController::class, 'active'])->name('user.active');
            Route::get('destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
        });

        Route::group(['prefix' => 'category'], function () {
            Route::group(['prefix' => 'content'], function () {
                Route::get('{id}', [CategoryController::class, 'content'])->name('category.content');
                Route::put('{id}', [CategoryController::class, 'contentUpdate'])->name('category.content-update');
            });

            Route::get('show/{id}', [CategoryController::class, 'show'])->name('category.show');
            Route::post('structure', [CategoryController::class, 'structure'])->name('category.structure');
            Route::get('form/{id?}', [CategoryController::class, 'form'])->name('category.form');
            Route::get('active/{id}', [CategoryController::class, 'active'])->name('category.active');
            Route::get('destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
            Route::get('list', [CategoryController::class, 'index'])->name('category.index');
            Route::post('', [CategoryController::class, 'store'])->name('category.store');
            Route::put('{id}', [CategoryController::class, 'update'])->name('category.update');
        });

        Route::group(['prefix' => 'content'], function () {
            Route::get('download/{file_gallery_id}', [ContentsController::class, 'download'])->name('content.download');
            Route::get('export', [ContentsController::class, 'export'])->name('content.export');
            Route::get('list/{category_id}', [ContentsController::class, 'index'])->name('content.index');
            Route::get('form/{id?}', [ContentsController::class, 'form'])->name('content.form');
            Route::post('form', [ContentsController::class, 'store'])->name('content.store');
            Route::put('form/{id}', [ContentsController::class, 'update'])->name('content.update');
            Route::get('active/{id}', [ContentsController::class, 'active'])->name('content.active');
            Route::get('destroy/{id}', [ContentsController::class, 'destroy'])->name('content.destroy');
        });

        Route::group(['prefix' => 'file'], function () {

            Route::get('form/{id}', [FileController::class, 'form'])->name('file.form');
            Route::post('update/{id}', [FileController::class, 'update'])->name('file.update');
            Route::get('active/{id}', [FileController::class, 'active'])->name('file.active');
            Route::get('destroy/{id}', [FileController::class, 'destroy'])->name('file.destroy');

            Route::post('submit/{module}/{link_id}/{file_gallery_id}', [FileController::class, 'submitFiles'])->name('file.upload-submit');

            Route::get('download/{id}', [FileController::class, 'download'])->name('file.download');
            Route::get('{module}/{link_id}', [FileController::class, 'listGalleries'])->name('file.list-galleries');
        });

        /**
         * CONFIGS
         */

        Route::group(['prefix' => 'language'], function () {
            Route::get('list', [LanguageController::class, 'index'])->name('language.index');
            Route::get('form/{id?}', [LanguageController::class, 'form'])->name('language.form');
            Route::post('form', [LanguageController::class, 'store'])->name('language.store');
            Route::put('form/{id}', [LanguageController::class, 'update'])->name('language.update');
            Route::get('active/{id}', [LanguageController::class, 'active'])->name('language.active');
            Route::get('destroy/{id}', [LanguageController::class, 'destroy'])->name('language.destroy');
            Route::get('export', [LanguageController::class, 'export'])->name('language.export');
        });

        Route::group(['prefix' => 'file-gallery'], function () {
            Route::get('list', [FileGalleryController::class, 'index'])->name('file-gallery.index');
            Route::get('form/{id?}', [FileGalleryController::class, 'form'])->name('file-gallery.form');
            Route::post('form', [FileGalleryController::class, 'store'])->name('file-gallery.store');
            Route::put('form/{id}', [FileGalleryController::class, 'update'])->name('file-gallery.update');
            Route::get('active/{id}', [FileGalleryController::class, 'active'])->name('file-gallery.active');
            Route::get('destroy/{id}', [FileGalleryController::class, 'destroy'])->name('file-gallery.destroy');
            Route::get('export', [FileGalleryController::class, 'export'])->name('file-gallery.export');
        });
    });
});
