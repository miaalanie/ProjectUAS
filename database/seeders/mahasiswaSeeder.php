<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class mahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbmahasiswa')->insert([
            ['nim' => '312023001', 'namamahasiswa' => 'Isa'],
            ['nim' => '312023002', 'namamahasiswa' => 'Yusup'],
            ['nim' => '312023003', 'namamahasiswa' => 'Sifad'],
        ]);
    }
}
