<?php

namespace Database\Factories;

use App\Models\ProgramUnggulan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProgramUnggulan>
 */
class ProgramUnggulanFactory extends Factory
{
    protected $model = ProgramUnggulan::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_program' => $this->faker->sentence(3),
            'deskripsi'   => $this->faker->paragraph(),
            'image'       => $this->faker->imageUrl(640, 480, 'business', true, 'program'),
            'url'         => $this->faker->url(),
            'is_publish'  => $this->faker->boolean(80), // 80% kemungkinan true
        ];
    }
}
