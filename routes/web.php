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

Auth::routes(['verify' => true]);

Route::get('/', 'InicioController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');

Route::get('/business', 'BusinessController@index')->name('business');

Route::get('/business/category/{slug}', 'BusinessController@categoria')->name('business.category');

Route::get('/business/profile/{slug}', 'BusinessController@show')->name('business.show');

