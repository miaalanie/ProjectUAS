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
           // Admin 
            [
                'name' => 'Maya Nurhaliza',
                'email' => 'maya.admin@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
                'email_verified_at'=>now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mia Adelia',
                'email' => 'miaadeliaa27@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
                'email_verified_at'=>now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rudi Hartanto',
                'email' => 'rudi.admin@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
                'email_verified_at'=>now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Pakar
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.user@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'user',
                'email_verified_at'=>now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Siti Komariah',
                'email' => 'siti.user@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'user',
                'email_verified_at'=>now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // User
            [
                'name' => 'Rina Marlina',
                'email' => 'rina.user@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'user',
                'email_verified_at'=>now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dika Alfarizi',
                'email' => 'dika.user@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'user',
                'email_verified_at'=>now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
