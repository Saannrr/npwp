<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IdentitasPerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('identitas_perusahaans')->insert([
            [
                'nama_perusahaan' => 'PT. ABC Sejahtera',
                'npwp_perusahaan' => '123456789012345',
                'nik_perusahaan' => '987654321098765',
                'kategori_perusahaan' => 'Jasa Keuangan',
                'alamat' => 'Jl. Jend. Sudirman No. 1, Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_perusahaan' => 'CV. XYZ Makmur',
                'npwp_perusahaan' => '234567890123456',
                'nik_perusahaan' => '876543210987654',
                'kategori_perusahaan' => 'Perdagangan',
                'alamat' => 'Jl. MH Thamrin No. 2, Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_perusahaan' => 'PT. MNO Sukses',
                'npwp_perusahaan' => '345678901234567',
                'nik_perusahaan' => '765432109876543',
                'kategori_perusahaan' => 'Manufaktur',
                'alamat' => 'Jl. Gatot Subroto No. 3, Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
