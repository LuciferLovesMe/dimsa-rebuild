<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LowonganKerja>
 */
class LowonganKerjaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'posisi' => $this->faker->jobTitle(),
            'deskripsi' => $this->faker->paragraph(),
            'tanggal_mulai' => $this->faker->date(),
            'tanggal_selesai' => $this->faker->date(),
            'file' => $this->faker->filePath(),
            'is_publish' => $this->faker->boolean()
        ];
    }
}
