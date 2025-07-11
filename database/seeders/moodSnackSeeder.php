<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoodSnackSeeder extends Seeder
{
    public function run(): void
    {
        $now = now(); // Biar DRY

        DB::table('mood_snack')->insert([
            // Relaxed
            ['mood_id' => 1, 'snack_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['mood_id' => 1, 'snack_id' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['mood_id' => 1, 'snack_id' => 3, 'created_at' => $now, 'updated_at' => $now],

            // Calm
            ['mood_id' => 2, 'snack_id' => 4, 'created_at' => $now, 'updated_at' => $now],
            ['mood_id' => 2, 'snack_id' => 5, 'created_at' => $now, 'updated_at' => $now],
            ['mood_id' => 2, 'snack_id' => 6, 'created_at' => $now, 'updated_at' => $now],

            // Anxious
            ['mood_id' => 3, 'snack_id' => 7, 'created_at' => $now, 'updated_at' => $now],
            ['mood_id' => 3, 'snack_id' => 8, 'created_at' => $now, 'updated_at' => $now],
            ['mood_id' => 3, 'snack_id' => 9, 'created_at' => $now, 'updated_at' => $now],
            ['mood_id' => 3, 'snack_id' => 10, 'created_at' => $now, 'updated_at' => $now],

            // Tense
            ['mood_id' => 4, 'snack_id' => 11, 'created_at' => $now, 'updated_at' => $now],
            ['mood_id' => 4, 'snack_id' => 12, 'created_at' => $now, 'updated_at' => $now],
            ['mood_id' => 4, 'snack_id' => 13, 'created_at' => $now, 'updated_at' => $now],
            ['mood_id' => 4, 'snack_id' => 14, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
