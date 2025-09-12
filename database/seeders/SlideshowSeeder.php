<?php

namespace Database\Seeders;

use App\Models\Slideshow;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SlideshowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Slideshow::factory()->count(3)->create();
    }
}
