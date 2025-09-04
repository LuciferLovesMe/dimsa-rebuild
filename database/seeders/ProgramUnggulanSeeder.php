<?php

namespace Database\Seeders;

use App\Models\ProgramUnggulan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramUnggulanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         ProgramUnggulan::factory()->count(10)->create();
    }
}
