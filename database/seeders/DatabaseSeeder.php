<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\IdentitasPerusahaan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            IdentitasOrangSeeder::class,
            IdentitasPerusahaanSeeder::class,
            UserSeeder::class,
            PengaturanSeeder::class,
        ]);
    }
}
