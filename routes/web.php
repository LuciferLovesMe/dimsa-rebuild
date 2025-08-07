<?php

use App\Http\Controllers\Backend\PengumumanController;
use App\Http\Controllers\Backend\QnaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('pengumuman', PengumumanController::class)->except(['show']);
Route::resource('qna', QnaController::class)->except(['show']);
