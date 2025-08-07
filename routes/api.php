<?php

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
    Route::post('/{id}', [QnaController::class, 'destroy']);
});