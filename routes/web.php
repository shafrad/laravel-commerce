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
});

Route::resource('products','ProductController');
Route::resource('orders','OrderController');
Route::resource('dashboard/orders','Dashboard\AdminOrderController', [
    'as' => 'dashboards'
]);
Route::resource('dashboard/products','Dashboard\AdminProductController', [
    'as' => 'dashboards'
]);
Route::resource('dashboard/users','Dashboard\AdminUserController', [
    'as' => 'dashboards'
]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
