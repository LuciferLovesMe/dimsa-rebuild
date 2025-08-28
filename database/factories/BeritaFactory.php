<?php

namespace Database\Factories;

use App\Models\KategoriBerita;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Berita>
 */
class BeritaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $kategori = KategoriBerita::pluck('id')->toArray();

        $judul = $this->faker->sentence();

        return [
            'judul' => $judul,
            'penulis' => $this->faker->name(),
            'tanggal' => $this->faker->date(),
            'id_kategori_berita' => $this->faker->randomElement($kategori),
            'cover' => 'https://placehold.co/150x100?text=' . urlencode($judul),
            'isi' => $this->faker->paragraph(),
            'is_publish' => $this->faker->boolean()
        ];
    }
}
