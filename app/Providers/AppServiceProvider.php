<?php

namespace App\Providers;

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
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(GaleriInterface::class, GaleriRepository::class);
        $this->app->bind(PengumumanInterface::class, PengumumanRepository::class);
        $this->app->bind(QnaInterface::class, QnaRepository::class);
        $this->app->bind(AlumniInterface::class, AlumniRepository::class);
        $this->app->bind(LowonganKerjaInterface::class, LowonganKerjaRepository::class);
        $this->app->bind(TestimoniInterface::class, TestimoniRepository::class);
        $this->app->bind(EkstrakulikulerInterface::class, EkstrakulikulerRepository::class);
        $this->app->bind(AgendaInterface::class, AgendaRepository::class);
        $this->app->bind(PublikasiInterface::class, PublikasiRepository::class);
        $this->app->bind(FasilitasInterface::class, FasilitasRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $allPrograms = [
            [
                'slug' => 'kelas-khusus-cyber',
                'heroTitle' => 'Kelas Khusus Cyber',
                'heroDesc' => 'Kelas Khusus Cyber di Pondok Pesantren Darul Ihsan Muhammadiyah Sragen adalah salah satu program inovatif yang dirancang untuk memberikan keterampilan teknologi informasi kepada santri di era digital...',
                'heroImage' => asset('images/cyber-bg.webp'),
                'videoUrl' => 'https://www.youtube.com/embed/I1L_KWsHvDs',
                'videoTitle' => 'Video Profil Kelas Cyber',
            ],
            [
                'slug' => 'kelas-khusus-tahfidz',
                'heroTitle' => 'Kelas Khusus Tahfidz',
                'heroDesc' => 'Program ini difokuskan untuk mencetak para penghafal Al-Qur\'an yang mutqin, dengan metode pembelajaran yang terstruktur dan lingkungan yang kondusif untuk menghafal.',
                'heroImage' => 'https://placehold.co/1920x1080/16a34a/ffffff?text=Tahfidz',
                'videoUrl' => 'https://www.youtube.com/embed/VIDEO_ID_TAHFIDZ',
                'videoTitle' => 'Video Profil Kelas Tahfidz',
            ],
            [
                'slug' => 'kelas-khusus-programmer',
                'heroTitle' => 'Kelas Khusus Programmer',
                'heroDesc' => 'Program ini dirancang untuk mencetak para programmer handal yang siap menghadapi tantangan di dunia digital.',
                'heroImage' => 'https://placehold.co/1920x1080/16a34a/ffffff?text=Programmer',
                'videoUrl' => 'https://www.youtube.com/embed/VIDEO_ID_PROGRAMMER',
                'videoTitle' => 'Video Profil Kelas Programmer',
            ],
        ];

        View::share('allPrograms', $allPrograms);
    }
}
