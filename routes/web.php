<?php

use App\Models\Product;
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
    $data['products'] = Product::get();

    return view('welcome',$data);
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard','Admin\AdminStoreController@index')->name('admin_dashboard');

    Route::group(['prefix' => 'Category'], function () {
        Route::get('', 'Admin\CategoryController@index')->name('category');
        Route::post('/store', 'Admin\CategoryController@store');
        Route::get('/list', 'Admin\CategoryController@list')->name('categories.list');
    });

    Route::group(['prefix' => 'Products'], function () {
        Route::get('', 'Admin\ProductController@index')->name('product');
        Route::post('/store', 'Admin\ProductController@store')->name('product.store');
        Route::get('/list', 'Admin\ProductController@list')->name('product.list');
    });
});
