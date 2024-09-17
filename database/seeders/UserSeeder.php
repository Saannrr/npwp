<?php

namespace Database\Seeders;

use App\Models\User;
use Random\Randomizer;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            // identitas orang
            [
                'email' => 'aguswijaya@gmail.com',
                'password' => Hash::make('aguswijaya'),
                'passphrase' => Str::random(7),
                'role' => 'individual',
                'nama' => 'Agus Wijaya',
                'nip' => '197804150001',
                'jabatan' => 'Manager Keuangan',
                'npwp' => '012345678901234',
                'nik' => '3201234567890123',
                'alamat' => 'Jl. Merdeka No. 1, Jakarta',
                'kategori_perusahaan' => null, // null for individuals
                'created_at' => now(),
            ],
            [
                'email' => 'budi@gmail.com',
                'password' => Hash::make('budi'),
                'passphrase' => Str::random(7),
                'role' => 'individual',
                'nama' => 'Budi Santoso',
                'nip' => '198512230002',
                'jabatan' => 'Supervisor HRD',
                'npwp' => '112345678901234',
                'nik' => '3201234567890124',
                'alamat' => 'Jl. Sudirman No. 2, Jakarta',
                'kategori_perusahaan' => null, // null for individuals
                'created_at' => now(),
            ],
            [
                'email' => 'citra@gmail.com',
                'password' => Hash::make('citra'),
                'passphrase' => Str::random(7),
                'role' => 'individual',
                'nama' => 'Citra Wijaya',
                'nip' => '199006150003',
                'jabatan' => 'Staf Administrasi',
                'npwp' => '212345678901234',
                'nik' => '3201234567890125',
                'alamat' => 'Jl. Thamrin No. 3, Jakarta',
                'kategori_perusahaan' => null, // null for individuals
                'created_at' => now(),
            ],
            // identitas perusahaan
            [
                'email' => 'abcsejahtera@gmail.com',
                'password' => Hash::make('abcsejahtera'),
                'passphrase' => Str::random(7),
                'role' => 'company',
                'nama' => 'PT. ABC Sejahtera',
                'kategori_perusahaan' => 'Jasa Keuangan', // value for company
                'npwp' => '123456789012345',
                'nik' => null, // null for company
                'alamat' => 'Jl. Jend. Sudirman No. 1, Jakarta',
                'nip' => null, // null for company
                'jabatan' => null, // null for company
                'created_at' => now(),
            ],
            [
                'email' => 'xyzmakmur@gmail.com',
                'password' => Hash::make('xyzmakmur'),
                'passphrase' => Str::random(7),
                'role' => 'company',
                'nama' => 'CV. XYZ Makmur',
                'kategori_perusahaan' => 'Perdagangan', // value for company
                'npwp' => '234567890123456',
                'nik' => null, // null for company
                'alamat' => 'Jl. MH Thamrin No. 2, Jakarta',
                'nip' => null, // null for company
                'jabatan' => null, // null for company
                'created_at' => now(),
            ],
            [
                'email' => 'mnosukses@gmail.com',
                'password' => Hash::make('mnosukses'),
                'passphrase' => Str::random(7),
                'role' => 'company',
                'nama' => 'PT. MNO Sukses',
                'kategori_perusahaan' => 'Manufaktur', // value for company
                'npwp' => '345678901234567',
                'nik' => null, // null for company
                'alamat' => 'Jl. Gatot Subroto No. 3, Jakarta',
                'nip' => null, // null for company
                'jabatan' => null, // null for company
                'created_at' => now(),
            ]
        ]);
    }
}
