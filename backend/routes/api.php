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
    Route::get('artist', [ArtistController::class, 'index'])->middleware('checkRole:super_admin,artist_manager');
    Route::post('artist', [ArtistController::class, 'store'])->middleware('checkRole:artist_manager');
    Route::put('artist/{artist}', [ArtistController::class, 'update'])->middleware('checkRole:artist_manager');
    Route::delete('artist/{artist}', [ArtistController::class, 'delete'])->middleware('checkRole:artist_manager');

    Route::get('music', [MusicController::class, 'index'])->middleware('checkRole:super_admin,artist_manager,artist');
    Route::post('music', [MusicController::class, 'store'])->middleware('checkRole:artist');
    Route::put('music/{music}', [MusicController::class, 'update'])->middleware('checkRole:artist');
    Route::delete('music/{music}', [MusicController::class, 'delete'])->middleware('checkRole:artist');
});



Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
