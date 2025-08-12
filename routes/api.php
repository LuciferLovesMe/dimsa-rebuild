<?php

use App\Http\Controllers\API\AgendaController;
use App\Http\Controllers\API\AlumniController;
use App\Http\Controllers\API\EkstrakulikulerController;
use App\Http\Controllers\API\FasilitasController;
use App\Http\Controllers\API\GaleriController;
use App\Http\Controllers\API\LowonganKerjaController;
use App\Http\Controllers\API\MajalahController;
use App\Http\Controllers\API\PengumumanController;
use App\Http\Controllers\API\QnaController;
use App\Http\Controllers\API\TestimoniController;
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
});

Route::prefix('/lowongan-kerja')->group(function () {
    Route::get('/', [LowonganKerjaController::class, 'index']);
    Route::get('/{id}', [LowonganKerjaController::class, 'show']);
});

Route::prefix('/testimoni')->group(function () {
    Route::get('/', [TestimoniController::class, 'index']);
    Route::get('/{id}', [TestimoniController::class, 'show']);
});

Route::prefix('/ekstrakulikuler')->group(function () {
    Route::get('/', [EkstrakulikulerController::class, 'index']);
    Route::get('/{id}', [EkstrakulikulerController::class, 'show']);
});

Route::prefix('/agenda')->group(function () {
    Route::get('/', [AgendaController::class, 'index']);
    Route::get('/{id}', [AgendaController::class, 'show']);
});

Route::prefix('/majalah')->group(function () {
    Route::get('/', [MajalahController::class, 'index']);
    Route::get('/{id}', [MajalahController::class, 'show']);
});

Route::prefix('/galeri')->group(function () {
    Route::get('/', [GaleriController::class, 'index']);
    Route::get('/{id}', [GaleriController::class, 'show']);
});

Route::prefix('/fasilitas')->group(function () {
    Route::get('/', [FasilitasController::class, 'index']);
    Route::get('/{id}', [FasilitasController::class, 'show']);
});
