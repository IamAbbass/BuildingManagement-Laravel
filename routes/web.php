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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/profile/{id}','HomeController@edit');
Route::post('/profile/{id}/update','HomeController@update');

Auth::routes();

 // Route::resource('/block', 'BlockController@index')->name('home');

 Route::resource('/block','BlockController');
 Route::resource('/block/{id}/floor','FloorController');
 Route::resource('/block/{block_id}/floor/{floor_id}/flat','FlatController');
 Route::resource('expensehead','ExpenseHeadController');
 Route::resource('expensehead/{expensehead_id}/expense','ExpenseController');
