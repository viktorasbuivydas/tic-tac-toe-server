<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;
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

Route::resource('actions', Api\ActionController::class, ['only' => ['store']]);
Route::resource('boards', Api\BoardController::class, ['only' => ['show', 'store', 'update']]);
Route::resource('games', Api\GameController::class, ['only' => ['show', 'store', 'update']]);
Route::resource('logs', Api\LogController::class, ['only' => ['show', 'store']]);





