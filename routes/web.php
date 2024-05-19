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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/financas', [FinancesController::class, 'index']);
Route::get('/financas', [FinancesController::class, 'show']);
Route::post('/financas', [FinancesController::class, 'store']);
Route::delete('/financas/{id}', [FinancesController::class, 'destroy']);
