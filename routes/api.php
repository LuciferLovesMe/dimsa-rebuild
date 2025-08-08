<?php

use App\Http\Controllers\API\AlumniController;
use App\Http\Controllers\API\PengumumanController;
use App\Http\Controllers\API\QnaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/pengumuman')->group(function () {
    Route::get('/', [PengumumanController::class, 'index']);
    Route::get('/{id}', [PengumumanController::class, 'show']);
});

Route::prefix('/qna')->group(function () {
    Route::get('/', [QnaController::class, 'index']);
    Route::get('/{id}', [QnaController::class, 'show']);
});

Route::prefix('/alumni')->group(function () {
    Route::get('/', [AlumniController::class, 'index']);
    Route::get('/{id}', [AlumniController::class, 'show']);
    Route::post('/{id}', [AlumniController::class, 'update']);
});