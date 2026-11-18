<?php

namespace Database\Seeders;

use App\Models\Campaign;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $kategoriId = $this->kategoriId();

        $data = [
            ['Bantuan Paket Sekolah Anak Yatim', 'Penggalangan dana untuk tas, buku, alat tulis, dan seragam bagi anak yatim yang membutuhkan.', 75000000, 8500000, '2026-11-01', '2027-02-28'],
            ['Kebutuhan Harian Lansia Terlantar', 'Bantuan sembako, perlengkapan kebersihan, dan pemeriksaan kesehatan dasar untuk lansia terlantar.', 60000000, 4200000, '2026-11-01', '2027-03-31'],
            ['Pencegahan Eksploitasi Anak', 'Program edukasi dan pendampingan untuk mencegah eksploitasi anak di wilayah rawan sosial.', 90000000, 12000000, '2026-11-01', '2027-04-30'],
            ['Kelas Literasi Digital Keluarga', 'Kelas edukasi digital bagi orang tua dan anak agar lebih bijak menggunakan internet.', 45000000, 3500000, '2026-11-01', '2027-01-31'],
        ];

        foreach ($data as [$judul, $deskripsi, $target, $terkumpul, $mulai, $selesai]) {
            Campaign::updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($judul)],
                [
                    'kategori_id'     => $kategoriId,
                    'judul'           => $judul,
                    'deskripsi'       => $deskripsi,
                    'target_dana'     => $target,
                    'dana_terkumpul'  => $terkumpul,
                    'tanggal_mulai'   => $mulai,
                    'tanggal_selesai' => $selesai,
                    'status'          => 'aktif',
                ]
            );
        }
    }

    // Pakai kategori yang sudah ada, atau buat satu jika tabel kategoris masih kosong
    private function kategoriId(): int
    {
        $id = DB::table('kategoris')->value('id');

        if ($id) {
            return (int) $id;
        }

        $cols = Schema::getColumnListing('kategoris');
        $row = [];

        foreach (['nama', 'name', 'nama_kategori', 'judul'] as $kolom) {
            if (in_array($kolom, $cols, true)) {
                $row[$kolom] = 'Sosial';
                break;
            }
        }
        if (in_array('slug', $cols, true)) {
            $row['slug'] = 'sosial';
        }
        if (in_array('created_at', $cols, true)) {
            $row['created_at'] = now();
            $row['updated_at'] = now();
        }

        return (int) DB::table('kategoris')->insertGetId($row);
    }
}