<?php

namespace Database\Factories;

use App\Models\GuruStaff;
use App\Models\PengalamanKerja;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PengalamanKerja>
 */
class PengalamanKerjaFactory extends Factory
{
    protected $model = PengalamanKerja::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_guru_staff' => GuruStaff::factory(),
            'posisi' => $this->faker->jobTitle,
            'perusahaan' => $this->faker->company,
            'tahun_mulai' => $this->faker->year,
            'tahun_akhir' => $this->faker->optional()->year,

        ];
    }
}
