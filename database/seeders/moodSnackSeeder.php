<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoodSnackSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('mood_snack')->insert([
            [
                'id' => 1,
                'mood_id' => 1,
                'snack_id' => 1,
                'created_at' => '2025-07-20 00:13:05',
                'updated_at' => '2025-07-20 00:13:05',
            ],
            [
                'id' => 2,
                'mood_id' => 1,
                'snack_id' => 2,
                'created_at' => '2025-07-20 00:13:05',
                'updated_at' => '2025-07-20 00:13:05',
            ],
            [
                'id' => 3,
                'mood_id' => 2,
                'snack_id' => 3,
                'created_at' => '2025-07-20 00:13:05',
                'updated_at' => '2025-07-20 00:13:05',
            ],
            [
                'id' => 4,
                'mood_id' => 2,
                'snack_id' => 4,
                'created_at' => '2025-07-20 00:13:05',
                'updated_at' => '2025-07-20 00:13:05',
            ],
            [
                'id' => 5,
                'mood_id' => 3,
                'snack_id' => 5,
                'created_at' => '2025-07-20 00:13:05',
                'updated_at' => '2025-07-20 00:13:05',
            ],
            [
                'id' => 6,
                'mood_id' => 3,
                'snack_id' => 6,
                'created_at' => '2025-07-20 00:13:05',
                'updated_at' => '2025-07-20 00:13:05',
            ],
            [
                'id' => 7,
                'mood_id' => 4,
                'snack_id' => 7,
                'created_at' => '2025-07-20 00:13:05',
                'updated_at' => '2025-07-20 00:13:05',
            ],
            [
                'id' => 8,
                'mood_id' => 4,
                'snack_id' => 8,
                'created_at' => '2025-07-20 00:13:05',
                'updated_at' => '2025-07-20 00:13:05',
            ],
        ]);
    }
}
