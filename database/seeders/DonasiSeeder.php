<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Donasi;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class DonasiSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $campaignIds = Campaign::pluck('id')->toArray();

        for ($i = 0; $i < 20; $i++) {
            Donasi::create([
                'campaign_id'    => $faker->randomElement($campaignIds),
                'nama_donatur'   => $faker->name(),
                'email'          => $faker->unique()->safeEmail(),
                'no_telepon'     => $faker->phoneNumber(),
                'alamat'         => $faker->address(),
                'jumlah'         => $faker->numberBetween(10, 500) * 1000,
                'pesan'          => $faker->optional(0.6)->sentence(8),
                'tanggal_donasi' => $faker->date('Y-m-d', 'now'),
            ]);
        }
    }
}
