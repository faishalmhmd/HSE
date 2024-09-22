<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $data = [];

        // Generate 20 rows of data
        for ($i = 0; $i < 20; $i++) {
            $data[] = [
                'nama' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'no_hp' => '08' . $faker->numberBetween(10000000, 99999999),
                'status' => 'active',
                'tgl_lahir' => $faker->date('Y-m-d', '2000-01-01'),
                'tgl_masuk' => $faker->date('Y-m-d', '2024-01-01'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert all data into the karyawan table
        DB::table('karyawan')->insert($data);
    }
}
