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
        $program_name = $this->faker->sentence(3);
        return [
            'nama_program' => $program_name,
            'deskripsi'   => $this->faker->paragraph(),
            'image'       =>  'https://placehold.co/150x100?text=' . urlencode($program_name),
            'url'         => $this->faker->url(),
            'is_publish'  => $this->faker->boolean(80), // 80% kemungkinan true
        ];
    }
}
