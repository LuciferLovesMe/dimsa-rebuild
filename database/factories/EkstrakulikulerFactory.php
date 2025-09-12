<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ekstrakulikuler>
 */
class EkstrakulikulerFactory extends Factory
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
            'link' => $this->faker->url(),
            'image' => 'https://placehold.co/150x100?text=Ekstrakulikuler',
            'is_publish' => $this->faker->boolean(),
        ];
    }
}
