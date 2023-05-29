<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TradingSimulatorController;
use App\Http\Controllers\ExperimentSimulatorController;
use App\Http\Controllers\AdminController;
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
Route::get('/leaderboard', [App\Http\Controllers\TradingSimulatorController::class, 'leaderboard'])->name('leaderboard');
Route::get('/user/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');

Route::get('/experiment-simulator', [ExperimentSimulatorController::class, 'index'])->name('experiment-simulator.index');
Route::post('/experiment-simulator/simulate', [ExperimentSimulatorController::class, 'simulate'])->name('experiment-simulator.simulate');

Route::get('/admin/users', 'AdminController@users')->name('admin.users')->middleware('admin');
Route::post('/admin/make-admin/{id}', [AdminController::class, 'makeAdmin'])->middleware('admin');
Route::post('/admin/remove-admin/{id}', [AdminController::class, 'removeAdmin'])->middleware('admin');

Route::middleware('auth', 'admin')->group(function () {
    Route::get('/badges', 'App\Http\Controllers\BadgeController@index')->name('badges.index');
    Route::get('/badges/create', 'App\Http\Controllers\BadgeController@create')->name('badges.create');
    Route::post('/badges', 'App\Http\Controllers\BadgeController@store')->name('badges.store');
    Route::get('/badges/{badge}', 'App\Http\Controllers\BadgeController@show')->name('badges.show');
    Route::get('badges/{badge}/edit', 'BadgeController@edit')->name('badges.edit');
    Route::delete('/badges/{badge}', 'BadgeController@destroy')->name('badges.destroy');

});
Route::post('admin/assign-badge', [AdminController::class, 'assignBadge'])->name('admin.assignBadge');
Route::get('/admin/assign-badge/{user}', [App\Http\Controllers\AdminController::class, 'showAssignBadgeForm'])->name('assignBadge');
Route::post('/admin/assign-badge/{user}', [App\Http\Controllers\AdminController::class, 'assignBadge'])->name('assignBadge.post');





