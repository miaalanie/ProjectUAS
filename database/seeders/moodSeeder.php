<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoodSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('moods')->insert([
            [
                'min' => 0,
                'max' => 25,
                'jenis_mood' => 'Relaxed',
                'keterangan' => 'Occurs when heart rate is slow or normal and body temperature is warm or stable, indicating the body is in a restful and peaceful condition.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'min' => 26,
                'max' => 50,
                'jenis_mood' => 'Calm',
                'keterangan' => 'Typically happens when heart rate is slow or normal and body temperature is slightly cool, suggesting a stable and controlled emotional state.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'min' => 51,
                'max' => 75,
                'jenis_mood' => 'Anxious',
                'keterangan' => 'Appears when heart rate is slightly elevated and body temperature is normal or slightly low, indicating early signs of emotional disturbance or alertness.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'min' => 76,
                'max' => 100,
                'jenis_mood' => 'Tense',
                'keterangan' => 'Detected when heart rate is fast or very fast and body temperature is low or very low, showing a state of physical stress and mental tension.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
