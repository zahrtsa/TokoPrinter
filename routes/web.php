<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'App\Http\Controllers\custom\WelcomeController' . '@index')->name('welcome')->middleware('guest');

Auth::routes();

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', 'App\Http\Controllers\custom\AdminController' . '@index')->name('admin.home');
    Route::resource('product', 'App\Http\Controllers\ProductController');

    // order confirm
    Route::get('confirmation', 'App\Http\Controllers\custom\AdminController' . '@show')->name('orderAdmin.show');
    Route::get('confirm/{id}', 'App\Http\Controllers\custom\AdminController' . '@confirm')->name('orderAdmin.confirm');
    Route::get('cancel/{id}', 'App\Http\Controllers\custom\AdminController' . '@cancel')->name('orderAdmin.cancel');

    // transaction success
    Route::get('/transaction', 'App\Http\Controllers\custom\AdminController' . '@transactionshow')->name('transaction.show');

    // update
    Route::post('product/update/{id}', 'App\Http\Controllers\ProductController' . '@update')->name('product.update');

    // destroy
    Route::get('product/destroy/{id}', 'App\Http\Controllers\ProductController' . '@destroy')->name('product.destroy');
});


Route::prefix('home')->middleware(['auth', 'custom'])->group(function () {
    Route::get('/', 'App\Http\Controllers\HomeController' . '@index')->name('home');
    Route::resource('order', 'App\Http\Controllers\OrderController');

    // whistlist
    Route::get('whistlist/', 'App\Http\Controllers\WhistlistController' . '@show')->name('whistlist.show');
    Route::get('whistlist/store/{id}',  'App\Http\Controllers\WhistlistController' . '@store')->name('whistlist.store');
    Route::get('whistlist/destroy/{id}', 'App\Http\Controllers\WhistlistController' . '@destroy')->name('whistlist.destroy');

    // order User
    Route::get('orderDetail', 'App\Http\Controllers\OrderController' . '@index')->name('order.waitConfirm');
    Route::post('order/store/{id}', 'App\Http\Controllers\OrderController' . '@store')->name('order.store');
    Route::get('product/show/{id}', 'App\Http\Controllers\OrderController' . '@show')->name('order.show');
    Route::get('order/destroy/{id}', 'App\Http\Controllers\OrderController' . '@destroy')->name('order.destroy');

    // transaction
    // Route::resource('transaction', 'App\Http\Controllers\TransactionController');
    Route::post('transaction/store/{id}', 'App\Http\Controllers\TransactionController' . '@store')->name('transaction.store');
});
