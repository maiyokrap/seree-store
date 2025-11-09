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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard','Admin\AdminStoreController@index')->name('admin_dashboard');
    Route::get('/products','Admin\AdminStoreController@products')->name('admin_products');
    Route::get('/orders','Admin\AdminStoreController@orders')->name('admin_orders');
    Route::get('/report','Admin\AdminStoreController@report')->name('admin_report');
});
