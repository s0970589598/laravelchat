<?php

use App\Http\Controllers\CentrifugoProxyController;
use App\Http\Controllers\RoomController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace ('Api')->group(function () {
    Route::post('/api/rooms/add1', [RoomController::class, 'addrooms'])->name('rooms.addrooms');
});

Route::group([
    'middleware' => 'auth',
], function () {
    Route::post('/centrifugo/connect', [CentrifugoProxyController::class, 'connect']);
    Route::post('/rooms/{id}/publish', [RoomController::class, 'publish'])->name('rooms.publish');
    Route::post('/dialogue/{id}/publish', [DialogueController::class, 'publish'])->name('dialogue.publish');
});
