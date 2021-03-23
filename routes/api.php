<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/block', [App\Http\Controllers\ApiController::class, 'block']);
Route::get('/block/{id}', [App\Http\Controllers\ApiController::class, 'flats']);
Route::get('/flat/{id}', [App\Http\Controllers\ApiController::class, 'flat_details']);
Route::get('/expense/head', [App\Http\Controllers\ApiController::class, 'expense_head']);
Route::get('/expense/head/{head_id}', [App\Http\Controllers\ApiController::class, 'expense_head_details']);


// Route::post('/signin', [App\Http\Controllers\ApiController::class, 'signin']);
// // /api/expense/head/{id}?month=FEB-2021 - show all expenses linked to the head
// 
// // /api/report?month=FEB-2021 || /api/report?date=01-FEB-2021 show daily collection report
// Route::get('/api/expense/{head_id}/{month}', [App\Http\Controllers\ApiController::class, 'expense_head']);