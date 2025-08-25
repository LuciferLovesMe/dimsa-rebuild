<?php

namespace Database\Seeders;

use App\Models\Qna;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QnaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Qna::factory()->count(25)->create();
    }
}
