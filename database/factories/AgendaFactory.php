<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agenda>
 */
class AgendaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->sentence(),
            'datetime' => $this->faker->dateTime(),
            'alamat' => $this->faker->address(),
            'image' => $this->faker->imageUrl(),
            'is_publish' => $this->faker->boolean()
        ];
    }
}
