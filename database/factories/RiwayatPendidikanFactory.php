<?php

namespace Database\Factories;

use App\Models\RiwayatPendidikan;
use App\Models\GuruStaff;
use Illuminate\Database\Eloquent\Factories\Factory;

class RiwayatPendidikanFactory extends Factory
{
    protected $model = RiwayatPendidikan::class;

    public function definition()
    {
        return [
            'id_guru_staff' => GuruStaff::factory(),
            'tingkat_pendidikan' => $this->faker->randomElement(['SD', 'SMP', 'SMA', 'S1', 'S2']),
            'instansi' => $this->faker->company,
            'tahun_mulai' => $this->faker->year,
            'tahun_akhir' => $this->faker->year,
        ];
    }
}
