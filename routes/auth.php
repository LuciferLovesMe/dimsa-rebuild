<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'guest'])->group(function () {
    Route::controller(RegisteredUserController::class)->group(function () {
        Route::get('register', 'create')->name('register.index');
        Route::post('register', 'store')->name('register.store');
    });

    Route::controller(AuthenticatedSessionController::class)->group(function () {
        Route::get('login', 'create')->name('login');
        Route::post('login', 'store')->name('login.store');
    });
});

Route::middleware('auth')->group(function () {
    Route::controller(AuthenticatedSessionController::class)->group(function () {
        Route::post('logout', 'destroy')->name('logout');
    });
});