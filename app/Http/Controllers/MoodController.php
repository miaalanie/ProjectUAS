<?php

// app/Http/Controllers/MoodController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\MoodFuzzyTsukamoto;
use Illuminate\Support\Facades\Log;

class MoodController extends Controller
{
    public function processMood(Request $request)
{
    try {
        $suhu = floatval($request->input('suhu'));
        $detak = floatval($request->input('detak'));

        if (!$suhu || !$detak) {
            return response()->json(['error' => 'Data tidak lengkap'], 400);
        }

        $hasil = \App\Library\MoodFuzzyTsukamoto::hitung($suhu, $detak);

        return response()->json(['nilai' => $hasil]);
    } catch (\Throwable $e) {
        Log::error('Gagal hitung mood: ' . $e->getMessage()); // tanpa backslash karena udah di-import
            return response()->json([
                'error' => 'Gagal proses mood',
                'debug' => $e->getMessage()
            ], 500);
    }
}

}
