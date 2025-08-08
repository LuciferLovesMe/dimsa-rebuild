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
Route::get('/admin/program', function () {
    return view('pages.admin.program.index');
})->name('program');
Route::get('/admin/tatib', function () {
    return view('pages.admin.tata_tertib.index');
})->name('tatib');
Route::get('/admin/karya-ilmiah', function () {
    return view('pages.admin.karya_ilmiah.index');
})->name('karya-ilmiah');
Route::get('/admin/majalah', function () {
    return view('pages.admin.majalah.index');
})->name('majalah');
Route::get('/admin/galeri', function () {
    return view('pages.admin.galeri.index');
})->name('galeri');
Route::get('/admin/pengumuman', function () {
    return view('pages.admin.pengumuman.index');
})->name('pengumuman');
Route::get('/admin/qna', function () {
    return view('pages.admin.qna.index');
})->name('qna');
Route::get('/admin/alumni', function () {
    return view('pages.admin.alumni.index');
})->name('alumni');
Route::get('/admin/lowongan-kerja', function () {
    return view('pages.admin.lowongan_kerja.index');
})->name('lowongan-kerja');
Route::get('/admin/testimoni', function () {
    return view('pages.admin.testimoni.index');
})->name('testimoni');
Route::get('/admin/ekstrakurikuler', function () {
    return view('pages.admin.ekstrakurikuler.index');
})->name('ekstrakurikuler');
Route::get('/admin/fasilitas', function () {
    return view('pages.admin.fasilitas.index');
})->name('fasilitas');
