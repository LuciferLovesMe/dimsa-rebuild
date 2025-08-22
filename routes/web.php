<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('pages.auth.login');
})->name('login');

Route::get('/admin/dashboard', function () {
    return view('pages.admin.dashboard.index');
})->name('dashboard');
Route::get('/admin/slideshow', function () {
    return view('pages.admin.slideshow.index');
})->name('slideshow');



// Grup Rute untuk semua halaman di bawah "admin"
Route::prefix('admin')->name('admin.')->group(function () {

    Route::prefix('dewan')->name('dewan.')->group(function () {
        Route::get('/pimpinan', function () {

            $data = [
                ['id' => 1, 'nama' => 'Muhammad Rasyid', 'jabatan' => 'Pimpinan', 'status' => 1],
            ];

            return view('pages.admin.dewan.index', [
                'title' => 'Pimpinan',
                'breadcrumb3' => 'Data Pimpinan',
                'dewanData' => $data,
            ]);
        })->name('pimpinan');

        Route::get('/pengasuh', function () {

            $data = [
                ['id' => 1, 'nama' => 'Ahmad Subarjo', 'jabatan' => 'Pengasuh Putra', 'status' => 1],
                ['id' => 2, 'nama' => 'Siti Aminah', 'jabatan' => 'Pengasuh Putri', 'status' => 0],
            ];

            return view('pages.admin.dewan.index', [
                'title' => 'Pengasuh',
                'breadcrumb3' => 'Data Pengasuh',
                'dewanData' => $data,
            ]);
        })->name('pengasuh');
    });

    Route::prefix('staff')->name('staff')->group(function () {
        Route::get('/', function () {

            $data = [
                ['id' => 1, 'nama' => 'Muhammad Rasyid', 'jabatan' => 'Pimpinan', 'status' => 1],
                ['id' => 2, 'nama' => 'Siti Aminah', 'jabatan' => 'Pengasuh Putri', 'status' => 0],
                ['id' => 3, 'nama' => 'Ahmad Subarjo', 'jabatan' => 'Pengasuh Putra', 'status' => 1],
            ];

            return view('pages.admin.staff.index', [
                'title' => 'Guru & Staff',
                'breadcrumb3' => 'Guru & Staff',
                'staffData' => $data,
            ]);
        });


        Route::get('/add-staff', function () {
            return view('pages.admin.staff.add');
        })->name('.add-staff');
    });

    Route::prefix('partner')->name('partner')->group(function () {
        Route::get('/', function () {

            $data = [
                ['id' => 1, 'nama_mitra' => 'Google', 'logo' => 'logo-google.png', 'status' => 1],
                ['id' => 2, 'nama_mitra' => 'Microsoft', 'logo' => 'logo-microsoft.png', 'status' => 0],
                ['id' => 3, 'nama_mitra' => 'Apple', 'logo' => 'logo-apple.png', 'status' => 1],
                ['id' => 4, 'nama_mitra' => 'Oracle', 'logo' => 'logo-oracle.png', 'status' => 0],
            ];

            return view('pages.admin.partner.index', [
                'title' => 'Partner Lembaga',
                'breadcrumb3' => 'Partner Lembaga',
                'partnerData' => $data,
            ]);
        });
    });
    Route::prefix('program')->name('program')->group(function () {
        Route::get('/', function () {

            $data = [
                ['id' => 1, 'gambar_header' => 'gambar.png', 'nama_program' => 'Ngaji Bersama', 'deskripsi' => 'Program Studi Ngaji Bersama', 'status' => 1],

            ];

            return view('pages.admin.program.index', [
                'title' => 'Program Unggulan',
                'breadcrumb3' => 'Program Unggulan',
                'programData' => $data,
            ]);
        });
    });

    Route::prefix('tata-tertib')->name('tata-tertib')->group(function () {
        Route::get('/', function () {


            return view('pages.admin.tata_tertib.index', [
                'title' => 'Tata Tertib',
                'breadcrumb3' => 'Tata Tertib',
            ]);
        });
    });
});

Route::get('/admin/berita', function () {
    return view('pages.admin.berita.index');
})->name('berita');
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

// landing
Route::get('/', function () {
    return view('pages.guest.landing');
})->name('landing-page');

// profile
Route::get('/selayang-pandang', function () {
    return view('pages.guest.profil-sekolah.selayang-pandang');
})->name('selayang-pandang');

Route::get('/sejarah-pondok', function () {
    return view('pages.guest.profil-sekolah.sejarah-pondok');
})->name('sejarah-pondok');

Route::get('/visi-misi', function () {
    return view('pages.guest.profil-sekolah.visi-misi');
})->name('visi-misi');

Route::get('/struktur-organisasi', function () {
    return view('pages.guest.profil-sekolah.struktur-organisasi');
})->name('struktur-organisasi');

Route::get('/akreditasi', function () {
    return view('pages.guest.profil-sekolah.akreditasi');
})->name('akreditasi');

Route::get('/logo', function () {
    return view('pages.guest.profil-sekolah.logo');
})->name('logo');

Route::get('/pimpinan', function () {
    return view('pages.guest.profil-sekolah.pimpinan');
})->name('pimpinan');


// akdemik
Route::get('/akademik-smp', function () {
    return view('pages.guest.akademik.smp');
})->name('smp');

Route::get('/akademik-ma', function () {
    return view('pages.guest.akademik.ma');
})->name('ma');

// program
Route::get('kelas-cyber', function () {
    return view('pages.guest.program.kelas-cyber');
})->name('kelas-cyber');

Route::get('kelas-tahfidz', function () {
    return view('pages.guest.program.kelas-tahfidz');
})->name('kelas-tahfidz');

Route::get('kurikulum-pondok', function () {
    return view('pages.guest.program.kurikulum-pondok');
})->name('kurikulum-pondok');

Route::get('ekstrakurikuler', function () {
    return view('pages.guest.program.ekstrakurikuler');
})->name('ekstrakurikuler');

// fasilitas
Route::get('sarana-prasarana', function () {
    return view('pages.guest.fasilitas.sarana');
})->name('sarana-prasarana');

Route::get('tata-tertib', function () {
    return view('pages.guest.fasilitas.tata-tertib');
})->name('tata-tertib');


// berita
Route::get('kabar', function () {
    return view('pages.guest.berita.kabar');
})->name('kabar');

Route::get('karya-ilmiah', function () {
    return view('pages.guest.berita.karya-ilmiah');
})->name('karya-ilmiah');

Route::get('majalah', function () {
    return view('pages.guest.berita.majalah');
})->name('majalah');

Route::get('galeri', function () {
    return view('pages.guest.berita.galeri');
})->name('galeri');

Route::get('pengumuman', function () {
    return view('pages.guest.berita.pengumuman');
})->name('pengumuman');

Route::get('qna', function () {
    return view('pages.guest.berita.qna');
})->name('qna');

Route::get('alumni', function () {
    return view('pages.guest.berita.alumni');
})->name('alumni');

Route::get('lowongan-kerja', function () {
    return view('pages.guest.berita.lowogan-kerja');
})->name('lowongan-kerja');
