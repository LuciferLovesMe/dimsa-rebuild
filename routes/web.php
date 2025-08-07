<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.guest.landing');
})->name('landing-page');

Route::get('/login', function () {
    return view('pages.auth.login');
})->name('login');

Route::get('/admin/dewan', function () {
    return view('pages.admin.dewan.index');
})->name('dewan');
Route::get('/admin/staff', function () {
    return view('pages.admin.staff.index');
})->name('staff');
