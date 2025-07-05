<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class matkulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
        DB::table('tbmatkul')->insert([
            ['id' => 1, 'namamatkul' => 'Algorithma dan Pemrograman'],
            ['id' => 2, 'namamatkul' => 'Pemrograman Web Dasar'],
        ]);
    }
    }
}
