<?php

use App\Http\Controllers\Dashboard\BrandController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\LoginController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\TagController;
use App\Http\Controllers\Dashboard\ProductController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ], function () {
        Route::group(['middleware' => ['auth:admin'], 'as' => 'admin.', 'prefix' => 'admin'], function () {
            Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
            Route::group(['prefix' => 'settings', 'as' => 'setting.'], function () {
                Route::get('shipping-methods/{type}', [SettingController::class, 'editShipping'])->name('shipping.edit');
                Route::put('shipping-methods/{id}', [SettingController::class, 'updateShipping'])->name('shipping.update');

            });
            Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
                Route::get('edit', [ProfileController::class, 'edit'])->name('edit');
                Route::put('update', [ProfileController::class, 'update'])->name('update');

            });

            //Begin Categories Routes
            // Route::group(['as' => 'categories.', 'prefix' => 'categories'], function () {
            //     Route::get('/{type}', [CategoryController::class, 'index'])->name('index');
            //     Route::post('/{type}', [CategoryController::class, 'store'])->name('store');
            //     Route::get('/{type}/create', [CategoryController::class, 'create'])->name('create');
            //     Route::put('/{type}/{id}/update', [CategoryController::class, 'update'])->name('update');
            //     Route::delete('/{type}/{id}', [CategoryController::class, 'destroy'])->name('destroy');
            //     Route::get('/{type}/{id}/edit', [CategoryController::class, 'edit'])->name('edit');
            // });
            Route::resource('categories', CategoryController::class);
            //End Categories Routes

            //Begin Brands Routes
            Route::resource('brands', BrandController::class);
            //End Brands Routes

            //Begin Tags Routes
            Route::resource('tags', TagController::class);
            //End Tags Routes

            //Begin Products Routes
            Route::group(['prefix'=>'products','as'=> 'products.'], function(){
                Route::get('price/{product_id}', [ProductController::class, 'getPrice'])->name('price');
                Route::post('price', [ProductController::class, 'storePrice'])->name('price.store');
                Route::get('stock/{product_id}', [ProductController::class, 'getStock'])->name('stock');
                Route::post('stock', [ProductController::class, 'storeStock'])->name('stock.store');
                Route::get('images/{product_id}', [ProductController::class, 'getImages'])->name('images');
                Route::post('images', [ProductController::class, 'storeImages'])->name('images.store');
                Route::post('images/db', [ProductController::class, 'storeImagesDb'])->name('images.store.db');
                Route::delete('delete/image/{product_id}', [ProductController::class, 'destroyImg'])->name('images.destroy');
            });
            Route::resource('products', ProductController::class, ['except' => ['edit', 'show']]);
            //End Products Routes

            Route::get('logout', [LoginController::class, 'logout'])->name('logout');
        });

        Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['guest:admin']], function () {
            Route::get('login', [LoginController::class, 'create'])->name('login');
            Route::post('login', [LoginController::class, 'store'])->name('post.login');
        });
    });
