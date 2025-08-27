<?php

namespace Database\Seeders;



use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            GuruStaffSeeder::class,
            UserSeeder::class,
            PartnerSeeder::class,
            SlideshowSeeder::class,
            ProgramUnggulanSeeder::class,
        ]);

       
    }
}
