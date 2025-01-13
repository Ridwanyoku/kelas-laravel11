<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Siswa;
use App\Models\PembayaranKas;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Siswa::factory()
        ->count(10) // Buat 10 siswa
        ->create()
        ->each(function ($siswa) {
            PembayaranKas::factory()
                ->count(12) // 12 bulan pembayaran per siswa
                ->create(['siswa_id' => $siswa->id]);
        });

    }
}
