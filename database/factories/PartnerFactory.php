<?php

namespace Database\Factories;

use App\Models\Partner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\partner>
 */
class PartnerFactory extends Factory
{
    protected $model = Partner::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_mitra' => $this->faker->company,
            'logo' => $this->faker->imageUrl(200, 200, 'business', true, 'logo'),
            'is_publish' => $this->faker->boolean(80), // 80% kemungkinan true
        ];
    }
}
