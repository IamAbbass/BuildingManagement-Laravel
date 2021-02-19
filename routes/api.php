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
Route::post('/signin', [App\Http\Controllers\ApiController::class, 'signin']);


// /api/block - show all blocks
Route::get('/block', [App\Http\Controllers\ApiController::class, 'block']);

// /api/block/{id} - show all flats from that block
Route::get('/block/{id}', [App\Http\Controllers\ApiController::class, 'flats']);

// /api/flat/{id} - show single flat details
Route::get('/flat/{id}', [App\Http\Controllers\ApiController::class, 'flat_details']);


