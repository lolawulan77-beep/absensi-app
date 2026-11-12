<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'nip' => '0001',
            'email' => 'admin@absensi.test',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Budi Karyawan',
            'nip' => '1001',
            'email' => 'budi@absensi.test',
            'role' => 'karyawan',
            'password' => Hash::make('password'),
        ]);
    }
}