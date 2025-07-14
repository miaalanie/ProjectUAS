<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BodyTemperatureFuzzySeeder extends Seeder
{
    public function run()
    {
        DB::table('body_temperature_fuzzy')->insert([
            ['min' => null,   'max' => 32.9,  'label' => 'Temp Sangat Dingin', 'source' => 'Jurnal'],
            ['min' => 33.0,   'max' => 35.0,  'label' => 'Temp Dingin',        'source' => 'TA, Jurnal'],
            ['min' => 35.0,   'max' => 36.5,  'label' => 'Temp Normal',        'source' => 'TA, Jurnal'],
            ['min' => 36.6,   'max' => 37.5,  'label' => 'Temp Hangat',        'source' => 'Jurnal'],
        ]);
    }
}
