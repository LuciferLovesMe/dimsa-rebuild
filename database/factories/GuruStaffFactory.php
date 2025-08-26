<?php

namespace Database\Factories;

use App\Models\GuruStaff;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GuruStaff>
 */
class GuruStaffFactory extends Factory
{
    protected $model = GuruStaff::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama'       => $this->faker->name(),
            'role'       => $this->faker->randomElement(['gurustaff', 'pengasuh', 'pimpinan']),
            'is_publish' => $this->faker->boolean(80), // 80% true
            'jabatan'    => $this->faker->jobTitle(),        
            'image'      => $this->faker->imageUrl(300, 300, 'people', true, 'profile'),
        ];
    }
}
