<?php

use App\Http\Controllers\Backend\PengumumanController;
use App\Http\Controllers\Backend\QnaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/admin')->group(function () {
    Route::prefix('/pengumuman')->group(function () {
        Route::get('/', [PengumumanController::class, 'index']);
        Route::get('/{id}', [PengumumanController::class, 'show']);
        Route::post('/', [PengumumanController::class, 'store']);
        Route::post('/{id}', [PengumumanController::class, 'update']);
        Route::post('/{id}', [PengumumanController::class, 'destroy']);
    });

    Route::prefix('/qna')->group(function () {
        Route::get('/', [QnaController::class, 'index']);
        Route::get('/{id}', [QnaController::class, 'show']);
        Route::post('/', [QnaController::class, 'store']);
        Route::post('/{id}', [QnaController::class, 'update']);
        Route::post('/{id}', [QnaController::class, 'destroy']);
    });
});