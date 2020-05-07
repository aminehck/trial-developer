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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/transactions', 'HomeController@transactions')->name('transactions');
Route::get('/clients', 'HomeController@clients')->name('clients');
Route::get('/deals', 'HomeController@deals')->name('deals');

Route::get('/import', 'HomeController@import')->name('import');
Route::post('/import', 'HomeController@importCsv')->name('importCsv');
