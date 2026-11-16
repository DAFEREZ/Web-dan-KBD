<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $hash = Hash::make('Password123!'); // ganti setelah login pertama

        DB::table('users')->insert([
            ['username' => 'admin', 'password_hash' => $hash, 'role_id' => 1, 'anggota_id' => null],
            ['username' => 'siti',  'password_hash' => $hash, 'role_id' => 2, 'anggota_id' => 1],
            ['username' => 'dewi',  'password_hash' => $hash, 'role_id' => 3, 'anggota_id' => 2],
            ['username' => 'rina',  'password_hash' => $hash, 'role_id' => 4, 'anggota_id' => 3],
            ['username' => 'yuni',  'password_hash' => $hash, 'role_id' => 5, 'anggota_id' => 4],
        ]);
    }
}