<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alumni>
 */
class AlumniFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_alumni' => $this->faker->name(),
            'tahun_lulus' => $this->faker->year(),
            'lembaga' => $this->faker->boolean(),
            'pekerjaan' => $this->faker->jobTitle() . ' ' . $this->faker->company(),
            'image' => 'https://placehold.co/150x100?text=Alumni',
        ];
    }
}
