<?php

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

Route::get('/', 'ProductController@index');
Route::get('/products', 'ProductController@index');
Route::get('/create/product', 'ProductController@create');
Route::post('/product/store', 'ProductController@store');
Route::get('/edit/product/{datetime_submitted}','ProductController@edit');
Route::post('/edit/product/{datetime_submitted}','ProductController@update');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
