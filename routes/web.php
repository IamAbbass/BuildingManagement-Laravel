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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'home']);
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard']);


//Route::get('/import', [App\Http\Controllers\FlatController::class, 'import']);
Route::get('/cycle', [App\Http\Controllers\FlatController::class, 'cycle']);
Route::get('/search', [App\Http\Controllers\MaintenanceController::class, 'search']);
Route::post('/search', [App\Http\Controllers\MaintenanceController::class, 'search_process']);
Route::get('/slip/{id}/cancel', [App\Http\Controllers\MaintenanceController::class, 'cancel']);


Route::get('/flat', [App\Http\Controllers\FlatController::class, 'index']);
Route::get('/flat/{id}/edit', [App\Http\Controllers\FlatController::class, 'edit']);
Route::get('/flat/export/{id}', [App\Http\Controllers\FlatController::class, 'export']);
Route::get('/flat/export/{id}/defaulter', [App\Http\Controllers\FlatController::class, 'defaulter']);

Route::get('/flat/{id}/', [App\Http\Controllers\FlatController::class, 'show']);
Route::patch('/flat/{id}/', [App\Http\Controllers\FlatController::class, 'update']);
Route::get('/flat/{id}/print', [App\Http\Controllers\FlatController::class, 'print']);
Route::get('/flat/{id}/payment', [App\Http\Controllers\FlatController::class, 'payment']);
Route::post('/flat/{id}/payment', [App\Http\Controllers\FlatController::class, 'payment_save']);
Route::get('/slip/{id}', [App\Http\Controllers\FlatController::class, 'slip']);
Route::get('/contractor/slip/{id}', [App\Http\Controllers\ContractorController::class, 'slip']);

Route::resource('/expensehead', App\Http\Controllers\ExpenseHeadController::class);
Route::resource('/expense', App\Http\Controllers\ExpenseController::class);
Route::get('/expense/{id}/slip', [App\Http\Controllers\ExpenseController::class,'slip']);
Route::get('/profile', [App\Http\Controllers\ProfileController::class,'index']);
Route::post('/profile', [App\Http\Controllers\ProfileController::class,'update']);

Route::resource('/accounthead', App\Http\Controllers\AccountHeadController::class);
Route::resource('/employee', App\Http\Controllers\EmployeeController::class);
Route::resource('/contractor', App\Http\Controllers\ContractorController::class);

Route::get('/contractor/{id}/payment', [App\Http\Controllers\ContractorController::class,'payment']);
Route::post('/contractor/{id}/payment', [App\Http\Controllers\ContractorController::class,'payment_save']);
Route::get('/contractor/{id}/', [App\Http\Controllers\ContractorController::class, 'show']);
Route::get('/contractor/{id}/cancel', [App\Http\Controllers\ContractorController::class, 'cancel']);
Route::get('/contractor/{id}/print', [App\Http\Controllers\ContractorController::class, 'print']);



Route::get('/attendance', [App\Http\Controllers\AttendanceController::class, 'index']);
Route::resource('/flat/{id}/vehicle', App\Http\Controllers\VehicleController::class);

Route::get('/report/daily', [App\Http\Controllers\ReportController::class,'daily_report']);
Route::post('/report/daily', [App\Http\Controllers\ReportController::class,'daily_report_print']);
Route::get('/verify/{id}', [App\Http\Controllers\MaintenanceController::class,'verify']);
