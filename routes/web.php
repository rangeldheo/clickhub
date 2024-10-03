<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::resource('suppliers', App\Http\Controllers\SupplierController::class)->middleware('auth');
Route::resource('clients', App\Http\Controllers\ClientController::class)->middleware('auth');
Route::resource('products', App\Http\Controllers\ProductController::class)->middleware('auth');
Route::resource('catalogs', App\Http\Controllers\CatalogController::class)->middleware('auth');
Route::resource('client-catalog', App\Http\Controllers\ClientCatalogController::class)->middleware('auth');


Route::middleware(['auth'])->group(function () {
    Route::post('/choose-product/{product}', [ProductController::class, 'chooseProduct'])->name('product.chooseProduct');
    Route::post('/publish-product/{product}', [ProductController::class, 'publishProduct'])->name('product.publishProduct');
});
