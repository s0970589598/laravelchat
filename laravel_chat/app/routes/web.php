<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DialogueController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\RoomController;
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
    return redirect('/rooms');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/account', [AccountController::class, 'index'])->name('account.index');
Route::get('/dialogue', [DialogueController::class, 'index'])->name('dialogue.index');
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
Route::get('/media', [MediaController::class, 'index'])->name('media.index');

Route::group([
    'middleware' => 'auth',
], function () {
    Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
    Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
    Route::get('/rooms/{id}', [RoomController::class, 'show'])->name('rooms.show');
    Route::post('/rooms/{id}', [RoomController::class, 'join'])->name('rooms.join');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/api.php';
