<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PembayaranKas>
 */
class PembayaranKasFactory extends Factory
{
    public function definition()
    {
        return [
            'siswa_id' => \App\Models\Siswa::factory(), // Otomatis buat siswa
            'bulan' => $this->faker->monthName,
            'tahun' => $this->faker->year,
            'checklist' => $this->faker->numberBetween(0, 4),
        ];
    }
}

