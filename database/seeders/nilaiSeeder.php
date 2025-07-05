<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class nilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
        DB::table('tbnilai')->insert([
            [
            'id' => 1,
            'idmatkul' => 1,
            'tahunajar' => '2024',
            'semester' => '2',
            'nim' => '312023003',
            'nilai' => 90,
            'grade' => 'A',
        ],
        [
            'id' => 2,
            'idmatkul' => 1,
            'tahunajar' => '2024',
            'semester' => '2',
            'nim' => '312023001',
            'nilai' => 60,
            'grade' => 'D',
        ],
        [
            'id' => 3,
            'idmatkul' => 2,
            'tahunajar' => '2025',
            'semester' => '4',
            'nim' => '312023002',
            'nilai' => 75,
            'grade' => 'B',
        ],
        [
            'id' => 4,
            'idmatkul' => 2,
            'tahunajar' => '2025',
            'semester' => '4',
            'nim' => '312023001',
            'nilai' => 90,
            'grade' => 'A',
        ],

        ]);
    }
    }
}
