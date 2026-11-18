<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Pendidikan',              'deskripsi' => 'Program edukasi dan literasi.'],
            ['nama' => 'Pencegahan Eksploitasi',  'deskripsi' => 'Perlindungan anak di wilayah rawan.'],
            ['nama' => 'Lansia',                  'deskripsi' => 'Bantuan kebutuhan harian lansia.'],
            ['nama' => 'Anak Yatim',              'deskripsi' => 'Dukungan bagi anak yatim.'],
            ['nama' => 'Kesehatan',               'deskripsi' => 'Layanan dan bantuan kesehatan.'],
        ];

        foreach ($data as $item) {
            Kategori::create($item);
        }
    }
}
