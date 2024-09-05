<?php

namespace Database\Seeders;

use App\Models\Pengaturan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengaturanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pengaturan::create([
            'bertindak_sebagai' => 'pengurus',
            'identitas' => 'npwp',
            'npwp_id' => '212345678901234',
            'nama_penandatangan' => 'Citra Dewi',
            'user_id' => 1,
            'status' => 1,
            'created_at' => now(),
        ]);
    }
}
