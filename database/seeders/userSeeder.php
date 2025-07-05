<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
           // Admin Akademik
            [
                'name' => 'Maya Nurhaliza',
                'email' => 'maya.admin@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rudi Hartanto',
                'email' => 'rudi.admin@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Dosen
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.dosen@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'dosen',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Siti Komariah',
                'email' => 'siti.dosen@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'dosen',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Mahasiswa
            [
                'name' => 'Rina Marlina',
                'email' => 'rina.mahasiswa@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dika Alfarizi',
                'email' => 'dika.mahasiswa@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
