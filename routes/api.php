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

Route::post('/game/store', [\App\Http\Controllers\GameController::class, 'create']);
Route::get('/game/{uid}', [\App\Http\Controllers\GameController::class, 'show']);

Route::get('/board/{uid}', [\App\Http\Controllers\BoardController::class, 'show']);
Route::post('/board/move', [\App\Http\Controllers\BoardController::class, 'playerMove']);



