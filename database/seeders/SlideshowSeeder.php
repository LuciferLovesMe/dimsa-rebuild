<?php

namespace Database\Seeders;

use App\Models\slideshow;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SlideshowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        slideshow::factory()->count(3)->create();
    }
}
