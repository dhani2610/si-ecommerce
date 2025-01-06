<?php

namespace Database\Seeders;

use App\Models\CatatanKeuangan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CatatanKeuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        // Ganti jumlah data sesuai kebutuhan
        $totalData = 1000;

        for ($i = 0; $i < $totalData; $i++) {
            $date = $faker->dateTimeBetween('2022-01-01', '2023-12-31')->format('Y-m-d');

            CatatanKeuangan::create([
                'keterangan' => $faker->sentence,
                'saldo' => $faker->numberBetween(1000000, 10000000),
                'tanggal' => $date,
                'jenis' => $faker->randomElement(['Debet', 'Kredit']),
                'tipe' => $faker->randomElement(['Piutang', 'Utang', 'Pemasukan', 'Pengeluaran']),
            ]);
        }
    }
}
