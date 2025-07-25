<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SnackSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('snacks')->insert([
            [
                'id' => 1,
                'nama_snack' => 'Fitbar (Nuts / Fruits)',
                'foto_snack' => null,
                'kandungan_gizi' => 'Chewy granola bar made from oats, fruits, and nuts. Low in calories, high in fiber. Supports satiety, stabilizes energy, and improves mood.',
                'created_at' => '2025-07-20 00:13:05',
                'updated_at' => '2025-07-20 00:13:05',
                'deleted_at' => null,
            ],
            [
                'id' => 2,
                'nama_snack' => 'Buavita 100% Juice',
                'foto_snack' => null,
                'kandungan_gizi' => 'Made from 100% real fruit juice. Rich in vitamin C and antioxidants. Helps hydration, boosts immunity, and supports refreshed mood.',
                'created_at' => '2025-07-20 00:13:05',
                'updated_at' => '2025-07-20 00:13:05',
                'deleted_at' => null,
            ],
            [
                'id' => 3,
                'nama_snack' => 'Silverqueen',
                'foto_snack' => null,
                'kandungan_gizi' => 'Contains milk chocolate and cashew nuts. High in sugar and fat. Provides quick energy and stimulates dopamine release.',
                'created_at' => '2025-07-20 00:13:05',
                'updated_at' => '2025-07-20 00:13:05',
                'deleted_at' => null,
            ],
            [
                'id' => 4,
                'nama_snack' => 'Minuman Matcha',
                'foto_snack' => null,
                'kandungan_gizi' => 'Made from green tea extract. Rich in antioxidants and L-theanine. Promotes calmness, reduces stress, and increases mental clarity.',
                'created_at' => '2025-07-20 00:13:05',
                'updated_at' => '2025-07-20 00:13:05',
                'deleted_at' => null,
            ],
            [
                'id' => 5,
                'nama_snack' => 'Good Time',
                'foto_snack' => null,
                'kandungan_gizi' => 'Sweet baked cookies containing chocolate chips. High in sugar and carbs. Provides quick energy but may cause sugar crash.',
                'created_at' => '2025-07-20 00:13:05',
                'updated_at' => '2025-07-20 00:13:05',
                'deleted_at' => null,
            ],
            [
                'id' => 6,
                'nama_snack' => 'Minuman Sari Kacang Ijo',
                'foto_snack' => null,
                'kandungan_gizi' => 'Made from mung beans and coconut milk. Rich in protein, folate, and magnesium. Helps brain function and stabilizes emotions.',
                'created_at' => '2025-07-20 00:13:05',
                'updated_at' => '2025-07-20 00:13:05',
                'deleted_at' => null,
            ],
            [
                'id' => 7,
                'nama_snack' => 'Susu Ultramilk',
                'foto_snack' => null,
                'kandungan_gizi' => 'Source of protein, calcium, and vitamin D. Supports bone health, energy metabolism, and emotional balance.',
                'created_at' => '2025-07-20 00:13:05',
                'updated_at' => '2025-07-20 00:13:05',
                'deleted_at' => null,
            ],
            [
                'id' => 8,
                'nama_snack' => 'Kripik Pedas Lays',
                'foto_snack' => null,
                'kandungan_gizi' => 'Crunchy spicy chips high in salt and fat. Stimulates adrenaline and dopamine for temporary energy and alertness boost.',
                'created_at' => '2025-07-20 00:13:05',
                'updated_at' => '2025-07-20 00:13:05',
                'deleted_at' => null,
            ],
        ]);
    }
}
