<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Kategori;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // 4 campaign sesuai tampilan website
        $tetap = [
            ['Pendidikan', 'Dana Kelas Literasi Digital Keluarga',
             'Program edukasi digital bagi orang tua dan anak agar lebih bijak menggunakan internet.', 45000000, 3773456],
            ['Pencegahan Eksploitasi', 'Pencegahan Eksploitasi Anak di Wilayah Rawan',
             'Program edukasi dan pendampingan untuk mencegah eksploitasi anak di wilayah rawan sosial.', 90000000, 12000000],
            ['Lansia', 'Bantuan Kebutuhan Harian Lansia Terlantar',
             'Program bantuan sembako, perlengkapan kebersihan, dan pemeriksaan kesehatan dasar untuk lansia terlantar.', 60000000, 4200000],
            ['Anak Yatim', 'Bantuan Paket Sekolah Anak Yatim',
             'Program penggalangan dana untuk menyediakan tas, buku, alat tulis, dan seragam bagi anak yatim yang membutuhkan.', 75000000, 8500000],
        ];

        foreach ($tetap as [$kategori, $judul, $deskripsi, $target, $terkumpul]) {
            Campaign::create([
                'kategori_id'     => Kategori::where('nama', $kategori)->value('id'),
                'judul'           => $judul,
                'deskripsi'       => $deskripsi,
                'target_dana'     => $target,
                'dana_terkumpul'  => $terkumpul,
                'tanggal_mulai'   => $faker->date('Y-m-d', 'now'),
                'tanggal_selesai' => $faker->dateTimeBetween('+1 month', '+6 months')->format('Y-m-d'),
                'status'          => 'aktif',
            ]);
        }

        // 8 campaign tambahan dengan Faker (total 12 data)
        $kategoriIds = Kategori::pluck('id')->toArray();

        for ($i = 0; $i < 8; $i++) {
            $target = $faker->numberBetween(10, 100) * 1000000;
            Campaign::create([
                'kategori_id'     => $faker->randomElement($kategoriIds),
                'judul'           => 'Bantuan ' . $faker->words(3, true),
                'deskripsi'       => $faker->sentence(12),
                'target_dana'     => $target,
                'dana_terkumpul'  => $faker->numberBetween(0, (int) ($target * 0.5)),
                'tanggal_mulai'   => $faker->date('Y-m-d', 'now'),
                'tanggal_selesai' => $faker->dateTimeBetween('+1 month', '+6 months')->format('Y-m-d'),
                'status'          => $faker->randomElement(['aktif', 'selesai']),
            ]);
        }
    }
}
