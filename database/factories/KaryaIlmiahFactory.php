<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publikasi>
 */
class KaryaIlmiahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $judul = $this->faker->sentence();

        return [
            'judul' => $judul,
            'penulis' => $this->faker->name(),
            'image' =>  'https://placehold.co/150x100?text=' . urlencode($judul),
            'url' => $this->faker->url(),
            'tanggal_terbit' => $this->faker->date(),
            'type' => 'karya ilmiah',
            'is_publish' => $this->faker->boolean()
        ];
    }
}
