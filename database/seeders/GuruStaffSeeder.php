<?php

namespace Database\Seeders;

use App\Models\GuruStaff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuruStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GuruStaff::factory()->count(25)->create();
    }
}
