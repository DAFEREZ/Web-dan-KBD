<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['id' => 1, 'nama_role' => 'admin',      'deskripsi' => 'Kelola user & role, lihat audit log, tanpa akses data pribadi'],
            ['id' => 2, 'nama_role' => 'ketua',      'deskripsi' => 'Lihat & kelola semua data anggota'],
            ['id' => 3, 'nama_role' => 'sekretaris', 'deskripsi' => 'Input & edit data anggota'],
            ['id' => 4, 'nama_role' => 'bendahara',  'deskripsi' => 'Lihat data iuran saja, tanpa data pribadi sensitif'],
            ['id' => 5, 'nama_role' => 'anggota',    'deskripsi' => 'Lihat data diri sendiri'],
        ]);
    }
}