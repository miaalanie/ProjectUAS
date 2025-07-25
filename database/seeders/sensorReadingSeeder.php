<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class sensorReadingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sensor_readings')->insert([
            'suhu' => 36.8,
            'detak_jantung' => 89,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
