<?php

namespace Database\Seeders;

use App\Models\GuruStaff;
use App\Models\PengalamanKerja;
use App\Models\Prestasi;
use App\Models\RiwayatPendidikan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuruStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GuruStaff::factory()
            ->count(20)
            ->create()
            ->each(function ($guruStaff) {
                // Riwayat Pendidikan
                RiwayatPendidikan::factory()->count(3)->create([
                    'id_guru_staff' => $guruStaff->id,
                ]);

                // Pengalaman Kerja
                PengalamanKerja::factory()->count(5)->create([
                    'id_guru_staff' => $guruStaff->id,
                ]);

                // Prestasi
                Prestasi::factory()->count(4)->create([
                    'id_guru_staff' => $guruStaff->id,
                ]);
            });
    }
}
