<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\WelcomeController;
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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Route::prefix('dashboard')->middleware(['auth'])->group(function () {


        // Dashboard Route
        Route::get('/', [WelcomeController::class, 'index'])->name('dashboard.index');
        // Dashboard Route
        /*Route::get('/', function () {
            return view('dashboard.index');
        })->name('dashboard.index');
        Route::get('/index', function () {
            return view('dashboard.index');
        })->name('dashboard.index');*/


        // User Routes
        //Route::resource('users', UserController::class)->except('show');

        // Here Will Be All Routes To UserController
        Route::group(['prefix' => 'users', 'namespace' => 'users'], function () {

            Route::get('/add', [UserController::class, 'create'])->name('user.add');
            Route::post('/store', [UserController::class, 'store'])->name('user.store');
            Route::get('/index', [UserController::class, 'index'])->name('users.index');
            Route::get('/', [UserController::class, 'index'])->name('users.index');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
            Route::post('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
            Route::get('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');
        }); // End of Users Routes

        // Here Will Be All Routes To CategoryController
        Route::group(['prefix' => 'categories', 'namespace' => 'categories'], function () {

            Route::get('/add', [CategoryController::class, 'create'])->name('category.add');
            Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
            Route::get('/index', [CategoryController::class, 'index'])->name('categories.index');
            Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
            Route::post('/user/update/{id}', [CategoryController::class, 'update'])->name('category.update');
            Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
            Route::get('/category/del/{id}', [CategoryController::class, 'destroyWithPhotos'])->name('categories.destroy');
        }); // End of Categories Routes


        // Here Will Be All Routes To ProductController
        Route::group(['prefix' => 'products', 'namespace' => 'products'], function () {

            Route::get('/add', [ProductController::class, 'create'])->name('product.add');
            Route::post('/store', [ProductController::class, 'store'])->name('product.store');
            Route::get('/index', [ProductController::class, 'index'])->name('products.index');
            Route::get('/', [ProductController::class, 'index'])->name('products.index');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
            Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
            Route::get('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
        }); // End of Products Routes

    });// End of Dashboard Routes (Url/dashboard/....)

}); //End of All Routes






