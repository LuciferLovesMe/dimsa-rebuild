<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.guest.landing');
})->name('landing-page');

Route::get('/login', function () {
    return view('pages.auth.login');
})->name('login');

Route::get('/admin/dashboard', function () {
    return view('pages.admin.dashboard.index');
})->name('dashboard');
Route::get('/admin/slideshow', function () {
    return view('pages.admin.slideshow.index');
})->name('slideshow');
Route::get('/admin/dewan', function () {
    return view('pages.admin.dewan.index');
})->name('dewan');
Route::get('/admin/staff', function () {
    return view('pages.admin.staff.index');
})->name('staff');
Route::get('/admin/partner', function () {
    return view('pages.admin.partner.index');
})->name('partner');
Route::get('/admin/berita', function () {
    return view('pages.admin.berita.index');
})->name('berita');
