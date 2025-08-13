<?php

use App\Http\Controllers\Backend\AgendaController;
use App\Http\Controllers\Backend\AlumniController;
use App\Http\Controllers\Backend\EkstrakulikulerController;
use App\Http\Controllers\Backend\FasilitasController;
use App\Http\Controllers\Backend\GaleriController;
use App\Http\Controllers\Backend\LowonganKerjaController;
use App\Http\Controllers\Backend\MajalahController;
use App\Http\Controllers\Backend\PengumumanController;
use App\Http\Controllers\Backend\QnaController;
use App\Http\Controllers\Backend\TestimoniController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/admin/api')->group(function () {
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

    Route::prefix('/ekstrakulikuler')->group(function () {
        Route::get('/', [EkstrakulikulerController::class, 'index']);
        Route::get('/{id}', [EkstrakulikulerController::class, 'show']);
        Route::post('/', [EkstrakulikulerController::class, 'store']);
        Route::post('/{id}/update', [EkstrakulikulerController::class, 'update']);
        Route::post('/{id}/destroy', [EkstrakulikulerController::class, 'destroy']);
    });

    Route::prefix('/agenda')->group(function () {
        Route::get('/', [AgendaController::class, 'index']);
        Route::get('/{id}', [AgendaController::class, 'show']);
        Route::post('/', [AgendaController::class, 'store']);
        Route::post('/{id}/update', [AgendaController::class, 'update']);
        Route::post('/{id}/destroy', [AgendaController::class, 'destroy']);
    });

    Route::prefix('/majalah')->group(function () {
        Route::get('/', [MajalahController::class, 'index']);
        Route::get('/{id}', [MajalahController::class, 'show']);
        Route::post('/', [MajalahController::class, 'store']);
        Route::post('/{id}/update', [MajalahController::class, 'update']);
        Route::post('/{id}/destroy', [MajalahController::class, 'destroy']);
    });

    Route::prefix('/galeri')->group(function () {
        Route::get('/', [GaleriController::class, 'index'])->name('galeri.index');
        Route::get('/{id}', [GaleriController::class, 'show'])->name('galeri.show');
        Route::post('/', [GaleriController::class, 'store'])->name('galeri.store');
        Route::post('/{id}/update', [GaleriController::class, 'update'])->name('galeri.update');
        Route::post('/{id}/destroy', [GaleriController::class, 'destroy'])->name('galeri.destroy');
    });

    Route::prefix('/fasilitas')->group(function () {
        Route::get('/', [FasilitasController::class, 'index']);
        Route::get('/{id}', [FasilitasController::class, 'show']);
        Route::post('/', [FasilitasController::class, 'store']);
        Route::post('/{id}/update', [FasilitasController::class, 'update']);
        Route::post('/{id}/destroy', [FasilitasController::class, 'destroy']);
    });
});
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

    // Grup Rute untuk semua halaman di bawah "dewan"
    Route::prefix('dewan')->name('dewan.')->group(function () {

        // Rute untuk /admin/dewan/pimpinan
        Route::get('/pimpinan', function () {
            // Data ini nantinya bisa datang dari database
            $data = [
                ['id' => 1, 'nama' => 'Muhammad Rasyid', 'jabatan' => 'Pimpinan', 'status' => 1],
            ];
            // Mengirim data ke view 'dewan.show'
            return view('pages.admin.dewan.show', [
                'title' => 'Pimpinan',
                'breadcrumb3' => 'Data Pimpinan',
                'dewanData' => $data,
            ]);
        })->name('pimpinan');

        // Rute untuk /admin/dewan/pengasuh
        Route::get('/pengasuh', function () {
            // Data ini nantinya bisa datang dari database
            $data = [
                ['id' => 1, 'nama' => 'Ahmad Subarjo', 'jabatan' => 'Pengasuh Putra', 'status' => 1],
                ['id' => 2, 'nama' => 'Siti Aminah', 'jabatan' => 'Pengasuh Putri', 'status' => 0],
            ];
            // Mengirim data ke view 'dewan.show'
            return view('pages.admin.dewan.show', [
                'title' => 'Pengasuh',
                'breadcrumb3' => 'Data Pengasuh',
                'dewanData' => $data,
            ]);
        })->name('pengasuh');
    });
});

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
