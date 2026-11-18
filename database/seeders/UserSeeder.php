<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Akun tetap untuk demo (password: password123)
        User::updateOrCreate(
            ['email' => 'admin@akukamu.test'],
            [
                'name'     => 'Admin Aku & Kamu',
                'password' => Hash::make('password123'),
            ]
        );

        // 5 akun dummy dari Faker (password: password123)
        for ($i = 0; $i < 5; $i++) {
            User::create([
                'name'     => $faker->name(),
                'email'    => $faker->unique()->safeEmail(),
                'password' => Hash::make('password123'),
            ]);
        }
    }
}