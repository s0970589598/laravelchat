<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DialogueController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\MsgSampleController;
use App\Http\Controllers\MailSampleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SatisfactionController;
use App\Http\Controllers\SalutatoryController;


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
    return redirect('/dashboard');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::group([
    'middleware' => 'auth',
], function () {
    Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
    Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
    Route::get('/rooms/{id}', [RoomController::class, 'show'])->name('rooms.show');
    Route::post('/rooms/{id}', [RoomController::class, 'join'])->name('rooms.join');

    Route::get('/dialogue', [DialogueController::class, 'index'])->name('dialogue.index');
    Route::get('/dialogue/{id}', [DialogueController::class, 'show'])->name('dialogue.show');
    Route::get('/dialoguelist', [DialogueController::class, 'manage'])->name('dialogue.manage');

    Route::get('/account', [AccountController::class, 'index'])->name('account.index');
    Route::get('/account/upstatus/{id}', [AccountController::class, 'upstatus'])->name('account.upstatus');
    Route::post('/account/add', [AccountController::class, 'store'])->name('account.store');
    Route::post('/account/edit', [AccountController::class, 'update'])->name('account.update');

    Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
    Route::post('/faq/add', [FaqController::class, 'store'])->name('faq.store');
    Route::get('/faq/show/{id}', [FaqController::class, 'show'])->name('faq.show');
    Route::post('/faq/edit', [FaqController::class, 'update'])->name('faq.update');
    Route::get('/faq/upstatus/{id}', [FaqController::class, 'upstatus'])->name('faq.upstatus');

    Route::get('/media', [MediaController::class, 'index'])->name('media.index');
    Route::post('/media/add', [MediaController::class, 'store'])->name('media.store');
    Route::post('/media/edit', [MediaController::class, 'update'])->name('media.update');
    Route::get('/media/upstatus/{id}', [MediaController::class, 'upstatus'])->name('media.upstatus');

    Route::get('/msgsample', [MsgSampleController::class, 'index'])->name('msgsample.index');
    Route::post('/msgsample/add', [MsgSampleController::class, 'store'])->name('msgsample.store');
    Route::post('/msgsample/edit', [MsgSampleController::class, 'update'])->name('msgsample.update');
    Route::get('/msgsample/upstatus/{id}', [MsgSampleController::class, 'upstatus'])->name('msgsample.upstatus');

    Route::get('/mailsample', [MailsampleController::class, 'index'])->name('mailsample.index');
    Route::post('/mailsample/add', [MailsampleController::class, 'store'])->name('mailsample.store');
    Route::post('/mailsample/edit', [MailsampleController::class, 'update'])->name('mailsample.update');
    Route::get('/mailsample/upstatus/{id}', [MailsampleController::class, 'upstatus'])->name('mailsample.upstatus');

    Route::get('/salutatory', [SalutatoryController::class, 'index'])->name('salutatory.index');
    Route::post('/salutatory/add', [SalutatoryController::class, 'store'])->name('salutatory.store');
    Route::post('/salutatory/edit', [SalutatoryController::class, 'update'])->name('salutatory.update');
    Route::get('/salutatory/upstatus/{id}', [SalutatoryController::class, 'upstatus'])->name('salutatory.upstatus');


    Route::get('/satisfaction', [SatisfactionController::class, 'index'])->name('satisfaction.index');
    Route::get('/satisfaction/manage', [SatisfactionController::class, 'manage'])->name('satisfaction.manage');

    Route::post('/room/assign/apply',[RoomController::class, 'applyAssign'])->name('rooms.apply');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/api.php';
