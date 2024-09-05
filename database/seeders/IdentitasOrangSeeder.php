<?php

namespace Database\Seeders;

use App\Models\IdentitasOrang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IdentitasOrangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('identitas_orangs')->insert([
            [
                'id' => 1,
                'nama' => 'Agus Wijaya',
                'nip' => '197804150001',
                'jabatan' => 'Manager Keuangan',
                'npwp' => '012345678901234',
                'nik' => '3201234567890123',
                'alamat' => 'Jl. Merdeka No. 1, Jakarta'
            ],
            [
                'id' => 2,
                'nama' => 'Budi Santoso',
                'nip' => '198512230002',
                'jabatan' => 'Supervisor HRD',
                'npwp' => '112345678901234',
                'nik' => '3201234567890124',
                'alamat' => 'Jl. Sudirman No. 2, Jakarta'
            ],
            [
                'id' => 3,
                'nama' => 'Citra Dewi',
                'nip' => '199006150003',
                'jabatan' => 'Staf Administrasi',
                'npwp' => '212345678901234',
                'nik' => '3201234567890125',
                'alamat' => 'Jl. Thamrin No. 3, Jakarta'
            ],
            [
                'id' => 4,
                'nama' => 'Dian Kurniawan',
                'nip' => '198305050004',
                'jabatan' => 'Kepala Bagian IT',
                'npwp' => '312345678901234',
                'nik' => '3201234567890126',
                'alamat' => 'Jl. Gatot Subroto No. 4, Jakarta'
            ],
            [
                'id' => 5,
                'nama' => 'Eka Putra',
                'nip' => '197912240005',
                'jabatan' => 'Supervisor Marketing',
                'npwp' => '412345678901234',
                'nik' => '3201234567890127',
                'alamat' => 'Jl. Kuningan No. 5, Jakarta'
            ],
            [
                'id' => 6,
                'nama' => 'Fajar Pratama',
                'nip' => '198702180006',
                'jabatan' => 'Manager Operasional',
                'npwp' => '512345678901234',
                'nik' => '3201234567890128',
                'alamat' => 'Jl. Senayan No. 6, Jakarta'
            ],
            [
                'id' => 7,
                'nama' => 'Gita Larasati',
                'nip' => '199203250007',
                'jabatan' => 'Staf Keuangan',
                'npwp' => '612345678901234',
                'nik' => '3201234567890129',
                'alamat' => 'Jl. Kebon Sirih No. 7, Jakarta'
            ],
            [
                'id' => 8,
                'nama' => 'Hana Pratiwi',
                'nip' => '199005120008',
                'jabatan' => 'Staf Administrasi',
                'npwp' => '712345678901234',
                'nik' => '3201234567890130',
                'alamat' => 'Jl. Jend. Sudirman No. 8, Jakarta'
            ],
            [
                'id' => 9,
                'nama' => 'Iqbal Fauzi',
                'nip' => '198908180009',
                'jabatan' => 'Staf Keuangan',
                'npwp' => '812345678901234',
                'nik' => '3201234567890131',
                'alamat' => 'Jl. MH Thamrin No. 9, Jakarta'
            ],
            [
                'id' => 10,
                'nama' => 'Joko Purnomo',
                'nip' => '198709120010',
                'jabatan' => 'Manager Operasional',
                'npwp' => '912345678901234',
                'nik' => '3201234567890132',
                'alamat' => 'Jl. Jend. Sudirman No. 10, Jakarta'
            ]
        ]);
    }
}
