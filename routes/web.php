<?php

use App\Http\Controllers\Backend\AlumniController;
use App\Http\Controllers\Backend\LowonganKerjaController;
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
        Route::post('/{id}/update', [PengumumanController::class, 'update']);
        Route::post('/{id}/destroy', [PengumumanController::class, 'destroy']);
    });

    Route::prefix('/qna')->group(function () {
        Route::get('/', [QnaController::class, 'index']);
        Route::get('/{id}', [QnaController::class, 'show']);
        Route::post('/', [QnaController::class, 'store']);
        Route::post('/{id}/update', [QnaController::class, 'update']);
        Route::post('/{id}/destroy', [QnaController::class, 'destroy']);
    });

    Route::prefix('/alumni')->group(function () {
        Route::get('/', [AlumniController::class, 'index']);
        Route::get('/{id}', [AlumniController::class, 'show']);
        Route::post('/', [AlumniController::class, 'store']);
        Route::post('/{id}/update', [AlumniController::class, 'update']);
        Route::post('/{id}/destroy', [AlumniController::class, 'destroy']);
    });

    Route::prefix('/lowongan-kerja')->group(function () {
        Route::get('/', [LowonganKerjaController::class, 'index']);
        Route::get('/{id}', [LowonganKerjaController::class, 'show']);
        Route::post('/', [LowonganKerjaController::class, 'store']);
        Route::post('/{id}/update', [LowonganKerjaController::class, 'update']);
        Route::post('/{id}/destroy', [LowonganKerjaController::class, 'destroy']);
    });

    Route::prefix('/testimoni')->group(function () {
        Route::get('/', [TestimoniController::class, 'index']);
        Route::get('/{id}', [TestimoniController::class, 'show']);
        Route::post('/', [TestimoniController::class, 'store']);
        Route::post('/{id}/update', [TestimoniController::class, 'update']);
        Route::post('/{id}/destroy', [TestimoniController::class, 'destroy']);
    });
});