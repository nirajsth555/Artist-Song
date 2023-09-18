<?php

use App\Http\Controllers\Api\ArtistController;
use App\Http\Controllers\Api\MusicController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('artist', [ArtistController::class, 'index']);
    Route::post('artist', [ArtistController::class, 'store']);
    Route::put('artist/{artist}', [ArtistController::class, 'update']);
    Route::delete('artist/{artist}', [ArtistController::class, 'delete']);

    Route::get('music', [MusicController::class, 'index']);
    Route::post('music', [MusicController::class, 'store']);
    Route::put('music/{music}', [MusicController::class, 'update']);
    Route::delete('music/{music}', [MusicController::class, 'delete']);
});



Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
