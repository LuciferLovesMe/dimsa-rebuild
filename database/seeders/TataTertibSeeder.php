<?php

namespace Database\Seeders;

use App\Models\TataTertib;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TataTertibSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TataTertib::factory()->count(1)->create();
    }
}
