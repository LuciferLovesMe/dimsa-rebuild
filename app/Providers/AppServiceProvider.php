<?php

namespace App\Providers;

use App\Interfaces\Berita\BeritaInterface;
use App\Interfaces\Berita\KategoriBeritaInterface;
use App\Interfaces\DewanYayasan\PengasuhInterface;
use App\Interfaces\DewanYayasan\PimpinanInterface;
use App\Interfaces\Profile\ChangePassInterface;
use App\Interfaces\GuruStaffInterface;
use App\Interfaces\KaryaIlmiahInterface;
use App\Interfaces\PartnerInterface;
use App\Interfaces\Profile\ProfileInterface;
use App\Interfaces\ProgramUnggulanInterface;
use App\Interfaces\SlideshowInterface;
use App\Repositories\Berita\BeritaRepository;
use App\Repositories\Berita\KategoriBeritaRepository;
use App\Repositories\Profiles\ChangePassRepository;
use App\Repositories\DewanYayasan\PimpinanRepository;
use App\Repositories\GuruStaffRepository;
use App\Repositories\KaryaIlmiahRepository;
use App\Repositories\PartnerRepository;
use App\Repositories\DewanYayasan\PengasuhRepository;
use App\Repositories\Profiles\ProfileRepository;
use App\Repositories\ProgramUnggulanRepository;
use App\Repositories\SlideshowRepository;
use App\Interfaces\AgendaInterface;
use App\Interfaces\AlumniInterface;
use App\Interfaces\EkstrakulikulerInterface;
use App\Interfaces\FasilitasInterface;
use App\Interfaces\GaleriInterface;
use App\Interfaces\LowonganKerjaInterface;
use App\Interfaces\PengumumanInterface;
use App\Interfaces\PublikasiInterface;
use App\Interfaces\QnaInterface;
use App\Interfaces\TestimoniInterface;
use App\Repositories\AgendaRepository;
use App\Repositories\AlumniRepository;
use App\Repositories\EkstrakulikulerRepository;
use App\Repositories\FasilitasRepository;
use App\Repositories\GaleriRepository;
use App\Repositories\LowonganKerjaRepository;
use App\Repositories\PengumumanRepository;
use App\Repositories\PublikasiRepository;
use App\Repositories\QnaRepository;
use App\Repositories\TestimoniRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
