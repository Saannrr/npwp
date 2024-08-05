<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
           'name' => 'Ihsan Ramadhan',
            'email' => 'ihsan@gmail.com',
            'npwp' => '123456789012345',
            'nik' => '1234567890123456',
            'password' => Hash::make('rahasia'),
            'token' => 'test'
        ]);
    }
}
