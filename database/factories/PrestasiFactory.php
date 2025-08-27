<?php

namespace Database\Factories;

use App\Models\GuruStaff;
use App\Models\Prestasi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prestasi>
 */
class PrestasiFactory extends Factory
{
    protected $model = Prestasi::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         $tingkat = ['Sekolah','Kecamatan','Kabupaten','Provinsi','Nasional','Internasional'];
        $predikat = ['Juara 1','Juara 2','Juara 3','Harapan 1','Harapan 2','Harapan 3','Finalis','Peserta'];

        return [
            'id_guru_staff' => GuruStaff::factory(), // auto bikin guru staff kalau belum ada
            'nama_lomba'    => $this->faker->sentence(3), 
            'penyelenggara' => $this->faker->company(),
            'tingkat'       => $this->faker->randomElement($tingkat),
            'predikat'      => $this->faker->randomElement($predikat),
            'tahun'         => $this->faker->numberBetween(2000, now()->year),
        ];
    }
}
