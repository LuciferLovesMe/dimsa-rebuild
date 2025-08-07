<?php

use App\Http\Controllers\Backend\PengumumanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('pengumuman', PengumumanController::class)->except(['show']);
