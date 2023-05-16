<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TradingSimulatorController;

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


Route::middleware(['auth'])->get('/trading-simulator', [TradingSimulatorController::class, 'index']);
Route::post('/trading-simulator', [TradingSimulatorController::class, 'simulate'])->name('simulate');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
