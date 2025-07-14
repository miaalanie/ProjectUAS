<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HeartRateFuzzySeeder extends Seeder
{

    public function run()
    {
        DB::table('heart_rate_fuzzy')->insert([
            ['min' => null, 'max' => 59, 'label' => 'HR Lambat'],
            ['min' => 60, 'max' => 70, 'label' => 'HR Normal'],
            ['min' => 71, 'max' => 90, 'label' => 'HR Cepat'],
            ['min' => 91, 'max' => null, 'label' => 'HR Sangat Cepat'],
        ]);
    }
}
