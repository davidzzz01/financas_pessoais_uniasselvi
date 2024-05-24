<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FinancesController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/financas', [FinancesController::class, 'index']);
Route::get('/financas', [FinancesController::class, 'show']);
Route::post('/financas', [FinancesController::class, 'store'])->name('financas.store');
Route::delete('/financas/{id}', [FinancesController::class, 'destroy']);
Route::put('/financas/{id}', [FinancesController::class, 'update'])->name('financas.update');
Route::get('/financas/{id}/edit', [FinanceController::class,'edit'])->name('financas.edit');
