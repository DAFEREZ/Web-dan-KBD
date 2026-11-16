<?php

namespace Database\Seeders;

use App\Models\Anggota;
use Illuminate\Database\Seeder;

class AnggotaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['Siti Aminah',  'Ketua',      '3173010101800001', '081200000001', 'Jl. Kemanggisan Utara No. 1, Jakarta Barat'],
            ['Dewi Lestari', 'Sekretaris', '3173010101800002', '081200000002', 'Jl. Kemanggisan Utara No. 2, Jakarta Barat'],
            ['Rina Marlina', 'Bendahara',  '3173010101800003', '081200000003', 'Jl. Kemanggisan Ilir No. 3, Jakarta Barat'],
            ['Yuni Astuti',  'Anggota',    '3173010101800004', '081200000004', 'Jl. Kemanggisan Ilir No. 4, Jakarta Barat'],
            ['Ratna Sari',   'Anggota',    '3173010101800005', '081200000005', 'Jl. Kemanggisan Pulo No. 5, Jakarta Barat'],
        ];

        foreach ($data as [$nama, $jabatan, $nik, $hp, $alamat]) {
            Anggota::tambah($nama, $jabatan, $nik, $hp, $alamat);
        }
    }
}