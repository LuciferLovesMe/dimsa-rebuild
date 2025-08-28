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

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@inagata.com',
        //     'password' => Hash::make('12345678'),
        // ]);
        $this->call([
            GuruStaffSeeder::class,
            UserSeeder::class,
            PartnerSeeder::class,
            SlideshowSeeder::class,
            ProgramUnggulanSeeder::class,
            KategoriBeritaSeeder::class,
            BeritaSeeder::class,
            LowonganKerjaSeeder::class,
            PengumumanSeeder::class,
            PublikasiSeeder::class,
            QnaSeeder::class,
            AlumniSeeder::class,
            GaleriSeeder::class,
            FileSeeder::class,
            AgendaSeeder::class,
            TestimoniSeeder::class,
            EkstrakulikulerSeeder::class,

        ]);
    }
}
