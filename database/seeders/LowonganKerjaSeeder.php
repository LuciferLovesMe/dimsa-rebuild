<?php

namespace Database\Seeders;

use App\Models\LowonganKerja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LowonganKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LowonganKerja::factory()->count(25)->create();
    }
}
