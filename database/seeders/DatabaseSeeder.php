<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Year;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $years = [2025];

        foreach ($years as $year) {
            Year::firstOrCreate(['year' => $year]);
        }
}

}
