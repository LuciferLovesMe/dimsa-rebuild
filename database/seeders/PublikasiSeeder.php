<?php

namespace Database\Seeders;

use App\Models\Publikasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Publikasi::factory()->count(30)->create();
    }
}
