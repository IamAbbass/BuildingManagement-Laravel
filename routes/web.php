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
    return redirect('/home');
});

Auth::routes(['register'=>false,'reset'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('/flat', [App\Http\Controllers\FlatController::class, 'index']);
Route::get('/flat/{id}/edit', [App\Http\Controllers\FlatController::class, 'edit']);
Route::patch('/flat/{id}/', [App\Http\Controllers\FlatController::class, 'update']);
Route::get('/flat/{id}/payment', [App\Http\Controllers\FlatController::class, 'payment']);
Route::post('/flat/{id}/payment', [App\Http\Controllers\FlatController::class, 'payment_save']);
Route::get('/slip/{id}', [App\Http\Controllers\FlatController::class, 'slip']);

Route::resource('/expensehead', App\Http\Controllers\ExpenseHeadController::class);
Route::resource('/expense', App\Http\Controllers\ExpenseController::class);
Route::resource('/accounthead', App\Http\Controllers\AccountHeadController::class);
Route::resource('/employee', App\Http\Controllers\EmployeeController::class);
Route::resource('/contractor', App\Http\Controllers\ContractorController::class);
Route::get('/attendance', [App\Http\Controllers\AttendanceController::class, 'index']);
