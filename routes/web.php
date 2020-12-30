<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/{id}', 'HomeController@index')->name('cart');


Route::group(['middleware' =>['auth','admin']], function () {
    Route::get('/dashboard', 'ProductController@index')->name('product.dashboard');
    Route::get('/dashboard/create', 'ProductController@create')->name('product.create');
    Route::post('/dashboard/store', 'ProductController@store')->name('product.store');
    Route::get('/dashboard/delete/{id}', 'ProductController@delete')->name('product.delete');
    Route::get('/dashboard/edit/{id}', 'ProductController@edit')->name('product.edit');
    Route::post('/dashboard/update', 'ProductController@update')->name('product.update');  


    Route::get('user', 'UserController@index');
});
