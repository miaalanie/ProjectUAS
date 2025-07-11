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
                'nama_snack' => 'Fitbar (Nuts / Fruits)',
                'foto_snack' => null,
                'kandungan_gizi' => 'Contains oats, fruits, and nuts. Low in calories, high in fiber. Supports satiety and improves mood.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_snack' => 'Soyjoy (Raisin Almond / Blueberry)',
                'foto_snack' => null,
                'kandungan_gizi' => 'High in protein and made with real fruit and soy. Helps maintain blood sugar and emotional stability.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_snack' => 'Buavita 100% Juice',
                'foto_snack' => null,
                'kandungan_gizi' => 'Made from 100% real fruit juice. Rich in vitamin C, helps hydration and supports a refreshed mood.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_snack' => 'Snyder’s Mini Pretzel (60g)',
                'foto_snack' => null,
                'kandungan_gizi' => 'Low-sugar, baked snack. Provides carbs and salt balance to reduce tension and promote calmness.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_snack' => 'Mister Potato Pretzel Stix',
                'foto_snack' => null,
                'kandungan_gizi' => 'Crunchy snack with low fat and salt. Helps keep energy stable and maintains alertness.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_snack' => 'Garuda / Dua Kelinci Roasted Cashew',
                'foto_snack' => null,
                'kandungan_gizi' => 'Rich in healthy fats and magnesium. Supports brain function and stabilizes emotions.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_snack' => 'Fitbar Oat / Nestlé Milo Bar',
                'foto_snack' => null,
                'kandungan_gizi' => 'Contains oats and malt. Provides sustained energy and stabilizes mood with complex carbs.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_snack' => 'Quaker Chewy Granola Bar',
                'foto_snack' => null,
                'kandungan_gizi' => 'Chewy granola bar rich in fiber and oats. Helps reduce anxiety and maintain mental focus.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_snack' => 'Sari Roti Gandum',
                'foto_snack' => null,
                'kandungan_gizi' => 'Whole grain bread with complex carbohydrates. Good for mood balance and long-lasting energy.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_snack' => 'Quaker Instant Oatmeal Sachet',
                'foto_snack' => null,
                'kandungan_gizi' => 'Instant oats high in fiber and B vitamins. Supports serotonin production and calming effects.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_snack' => 'Soyjoy (Original / Raisin / Banana)',
                'foto_snack' => null,
                'kandungan_gizi' => 'Soy-based high-protein bar. Supports brain performance and reduces nervous tension.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_snack' => 'Fitbar Protein+',
                'foto_snack' => null,
                'kandungan_gizi' => 'Enhanced protein snack bar with low sugar. Helps reduce fatigue and sharpen mental clarity.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_snack' => 'Yamada Roasted Soybean Snack',
                'foto_snack' => null,
                'kandungan_gizi' => 'Crunchy soy snack with natural protein. Boosts satiety and mental performance.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_snack' => 'Amazin’ Graze Protein Mix',
                'foto_snack' => null,
                'kandungan_gizi' => 'Premium nut and seed mix rich in protein and healthy fats. Supports energy and emotional control.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
