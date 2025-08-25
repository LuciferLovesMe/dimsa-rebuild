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
        return [
            'judul' => $this->faker->sentence(),
            'penulis' => $this->faker->name(),
            'image' => $this->faker->imageUrl(),
            'url' => $this->faker->url(),
            'tanggal_terbit' => $this->faker->date(),
            'type' => 'karya ilmiah',
            'is_publish' => $this->faker->boolean()
        ];
    }
}
