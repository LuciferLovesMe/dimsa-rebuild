<?php

namespace Database\Factories;

use App\Models\slideshow;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slideshow>
 */
class SlideshowFactory extends Factory
{
    protected $model = slideshow::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      
        return [
            'file' => $this->faker->imageUrl(200, 200, 'business', true, 'logo'),
            'headline' => $this->faker->sentence(6, true),
        ];
    }
}
