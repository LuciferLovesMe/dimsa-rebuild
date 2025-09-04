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
        $company = $this->faker->company;
        return [
            'nama_mitra' => $company,
            'logo' => 'https://placehold.co/150x100?text=' . urlencode($company),
            'is_publish' => $this->faker->boolean(80),
        ];
    }
}
