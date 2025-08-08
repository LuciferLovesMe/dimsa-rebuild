<?php

namespace App\Providers;

use App\Interfaces\AlumniInterface;
use App\Interfaces\GaleriInterface;
use App\Interfaces\LowonganKerjaInterface;
use App\Interfaces\PengumumanInterface;
use App\Interfaces\QnaInterface;
use App\Repositories\AlumniRepository;
use App\Repositories\GaleriRepository;
use App\Repositories\LowonganKerjaRepository;
use App\Repositories\PengumumanRepository;
use App\Repositories\QnaRepository;
use Illuminate\Support\ServiceProvider;

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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
