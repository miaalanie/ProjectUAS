<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // kamu butuh ini juga kalau mau pakai Log

class SnackRekomendasiController extends Controller
{
    public function getSnack($jenis_mood)
    {
        try {
            $moodName = $jenis_mood; // dari parameter route
            if (!$moodName) {
                return response()->json(['error' => 'Mood kosong'], 400);
            }

            // Cari mood berdasarkan nama, ambil id-nya
            $mood = \App\Models\Mood::where('jenis_mood', $moodName)->first();
            if (!$mood) {
                return response()->json(['error' => 'Mood tidak ditemukan'], 404);
            }
            $moodId = $mood->id;

            // Ambil snack_id dari tabel pivot mood_snack berdasarkan mood_id
            $snackIds = \App\Models\MoodSnack::where('mood_id', $moodId)->pluck('snack_id');

            // Ambil data snack berdasarkan id yang didapat
            $snacks = \App\Models\Snack::whereIn('id', $snackIds)
                ->select('id', 'nama_snack', 'foto_snack', 'kandungan_gizi')
                ->get();

            return response()->json(['snack' => $snacks]);

        } catch (\Throwable $e) {
            Log::error('Gagal dapat data snack: ' . $e->getMessage());
            return response()->json([
                'error' => 'Gagal proses snack',
                'debug' => $e->getMessage()
            ], 500);
        }
    }
}
