<?php

namespace Database\Factories;

use App\Models\Alumni;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Testimoni>
 */
class TestimoniFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'alumni_id' => $this->faker->randomElement(Alumni::pluck('id')->toArray()),
            'testimoni' => $this->faker->sentence(),
            'is_publish' => $this->faker->boolean()
        ];
    }
}
