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
                'profileable_id' => 1,
                'profileable_type' => 'App\Models\IdentitasOrang',
                'created_at' => now(),
            ],
            [
                'email' => 'budi@gmail.com',
                'password' => Hash::make('budi'),
                'passphrase' => Str::random(7),
                'role' => 'individual',
                'profileable_id' => 2,
                'profileable_type' => 'App\Models\IdentitasOrang',
                'created_at' => now(),
            ],
            [
                'email' => 'citra@gmail.com',
                'password' => Hash::make('citra'),
                'passphrase' => Str::random(7),
                'role' => 'individual',
                'profileable_id' => 3,
                'profileable_type' => 'App\Models\IdentitasOrang',
                'created_at' => now(),
            ],
            [
                'email' => 'dian@gmail.com',
                'password' => Hash::make('dian'),
                'passphrase' => Str::random(7),
                'role' => 'individual',
                'profileable_id' => 4,
                'profileable_type' => 'App\Models\IdentitasOrang',
                'created_at' => now(),
            ],
            [
                'email' => 'eka@gmail.com',
                'password' => Hash::make('eka'),
                'passphrase' => Str::random(7),
                'role' => 'individual',
                'profileable_id' => 5,
                'profileable_type' => 'App\Models\IdentitasOrang',
                'created_at' => now(),
            ],
            [
                'email' => 'fajar@gmail.com',
                'password' => Hash::make('fajar'),
                'passphrase' => Str::random(7),
                'role' => 'individual',
                'profileable_id' => 6,
                'profileable_type' => 'App\Models\IdentitasOrang',
                'created_at' => now(),
            ],
            [
                'email' => 'gita@gmail.com',
                'password' => Hash::make('gita'),
                'passphrase' => Str::random(7),
                'role' => 'individual',
                'profileable_id' => 7,
                'profileable_type' => 'App\Models\IdentitasOrang',
                'created_at' => now(),
            ],
            [
                'email' => 'hana@gmail.com',
                'password' => Hash::make('hana'),
                'passphrase' => Str::random(7),
                'role' => 'individual',
                'profileable_id' => 8,
                'profileable_type' => 'App\Models\IdentitasOrang',
                'created_at' => now(),
            ],
            [
                'email' => 'iqbal@gmail.com',
                'password' => Hash::make('iqbal'),
                'passphrase' => Str::random(7),
                'role' => 'individual',
                'profileable_id' => 9,
                'profileable_type' => 'App\Models\IdentitasOrang',
                'created_at' => now(),
            ],
            [
                'email' => 'joko@gmail.com',
                'password' => Hash::make('joko'),
                'passphrase' => Str::random(7),
                'role' => 'individual',
                'profileable_id' => 10,
                'profileable_type' => 'App\Models\IdentitasOrang',
                'created_at' => now(),
            ],
            // identitas perusahaan
            [
                'email' => 'abcsejahtera@gmail.com',
                'password' => Hash::make('abcsejahtera'),
                'passphrase' => Str::random(7),
                'role' => 'company',
                'profileable_id' => 1,
                'profileable_type' => 'App\Models\IdentitasPerusahaan',
                'created_at' => now(),
            ],
            [
                'email' => 'xyzmakmur@gmail.com',
                'password' => Hash::make('xyzmakmur'),
                'passphrase' => Str::random(7),
                'role' => 'company',
                'profileable_id' => 2,
                'profileable_type' => 'App\Models\IdentitasPerusahaan',
                'created_at' => now(),
            ],
            [
                'email' => 'mnosukses@gmail.com',
                'password' => Hash::make('mnosukses'),
                'passphrase' => Str::random(7),
                'role' => 'company',
                'profileable_id' => 3,
                'profileable_type' => 'App\Models\IdentitasPerusahaan',
                'created_at' => now(),
            ]
        ]);
    }
}
