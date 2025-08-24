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

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\Berita\BeritaController;
use App\Http\Controllers\API\Berita\KategoriBeritaController;
use App\Http\Controllers\API\DewanYayasan\PengasuhController;
use App\Http\Controllers\API\DewanYayasan\PimpinanController;
use App\Http\Controllers\API\GuruStaff\GuruStaffController;
use App\Http\Controllers\API\KaryaIlmiah\KaryaIlmiahController;
use App\Http\Controllers\API\Partner\PartnerController;
use App\Http\Controllers\API\Profile\ChangePassController;
use App\Http\Controllers\API\Profile\ProfileController;
use App\Http\Controllers\API\ProgramUnggulan\ProgramUnggulanController;
use App\Http\Controllers\API\Slideshow\SlideshowController;
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





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register'])->name('api.register.store');
Route::post('/login/api', [AuthController::class, 'login'])->name('api.login.store');

Route::middleware('auth:sanctum')->prefix('admin')->group(function () {

    Route::prefix('profile')->controller(ProfileController::class)->group(function () {
        Route::put('/update', 'update')->name('profile.update');
        Route::get('/show', 'show')->name('profile.show');
    });

    Route::prefix('profile')->controller(ChangePassController::class)->group(function () {
        Route::put('/change-pass', 'update')->name('change_pass.update');
    });

    Route::prefix('slideshow')->controller(SlideshowController::class)->group(function () {
        Route::post('/create', 'store')->name('slideshow.store');
        Route::get('/showAll', 'showAll')->name('slideshow.showAll');
        Route::get('/show/{id}', 'show')->name('slideshow.show');
        Route::put('/update', 'update')->name('slideshow.update');
        Route::delete('/delete/{id}', 'destroy')->name('slideshow.destroy');
    });

    Route::prefix('dewan-yayasan')->group(function () {
        Route::prefix('pengasuh')->controller(PengasuhController::class)->group(function () {
            Route::post('/create', 'store')->name('pengasuh.store');
            Route::get('/showAll', 'showAll')->name('pengasuh.showAll');
            Route::get('/show/{id}', 'show')->name('pengasuh.show');
            Route::put('/update/{id}', 'update')->name('pengasuh.update');
            Route::delete('/delete/{id}', 'destroy')->name('pengasuh.destroy');
        });
    });

    Route::prefix('dewan-yayasan')->group(function () {
        Route::prefix('pimpinan')->controller(PimpinanController::class)->group(function () {
            Route::post('/create', 'store')->name('pimpinan.store');
            Route::get('/showAll', 'showAll')->name('pimpinan.showAll');
            Route::get('/show/{id}', 'show')->name('pimpinan.show');
            Route::put('/update/{id}', 'update')->name('pimpinan.update');
            Route::delete('/delete/{id}', 'destroy')->name('pimpinan.destroy');
        });
    });

    Route::prefix('guru-staff')->controller(GuruStaffController::class)->group(function () {
        Route::post('/create', 'store')->name('gurustaff.store');
        Route::get('/showAll', 'showAll')->name('gurustaff.showAll');
        Route::get('/show/{id}', 'show')->name('gurustaff.show');
        Route::put('/update/{id}', 'update')->name('gurustaff.update');
        Route::delete('/delete/{id}', 'destroy')->name('gurustaff.destroy');
    });

    Route::prefix('partner')->controller(PartnerController::class)->group(function () {
        Route::post('/create', 'store')->name('partner.store');
        Route::get('/showAll', 'showAll')->name('partner.showAll');
        Route::get('/show/{id}', 'show')->name('partner.show');
        Route::put('/update/{id}', 'update')->name('partner.update');
        Route::delete('/delete/{id}', 'destroy')->name('partner.destroy');
    });

    Route::prefix('program-unggulan')->controller(ProgramUnggulanController::class)->group(function () {
        Route::post('/create', 'store')->name('programunggulan.store');
        Route::get('/showAll', 'showAll')->name('programunggulan.showAll');
        Route::get('/show/{id}', 'show')->name('programunggulan.show');
        Route::put('/update/{id}', 'update')->name('programunggulan.update');
        Route::delete('/delete/{id}', 'destroy')->name('programunggulan.destroy');
    });

    Route::prefix('kategori-berita')->controller(KategoriBeritaController::class)->group(function () {
        Route::post('/create', 'store')->name('kategoriberita.store');
        Route::get('/showAll', 'showAll')->name('kategoriberita.showAll');
        Route::get('/show/{id}', 'show')->name('kategoriberita.show');
        Route::put('/update/{id}', 'update')->name('kategoriberita.update');
        Route::put('/publish/{id}', 'published')->name('kategoriberita.publish');
        Route::delete('/delete/{id}', 'destroy')->name('kategoriberita.destroy');
    });

    Route::prefix('berita')->controller(BeritaController::class)->group(function () {
        Route::post('/create', 'store')->name('berita.store');
        Route::get('/showAll', 'index')->name('berita.showAll');
        Route::get('/show/{slug}', 'show')->name('berita.show');
        Route::put('/update/{id}', 'update')->name('berita.update');
        Route::delete('/delete/{id}', 'destroy')->name('berita.destroy');
    });

    Route::prefix('karya-ilmiah')->controller(KaryaIlmiahController::class)->group(function () {
        Route::post('/create', 'store')->name('karyailmiah.store');
        Route::get('/showAll', 'showAll')->name('karyailmiah.showAll');
        Route::get('/show/{id}', 'show')->name('karyailmiah.show');
        Route::put('/update/{id}', 'update')->name('karyailmiah.update');
        Route::delete('/delete/{id}', 'destroy')->name('karyailmiah.destroy');
    });
});