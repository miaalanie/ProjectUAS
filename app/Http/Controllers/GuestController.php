<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function dashboard() {
        return view('guest.dashboard');
    }

    public function mulaiDiagnosa() {
        return view('guest.mulaiDiagnosa');
    }
    public function diagnosa() {
        return view('guest.diagnosa');
    }

    public function tentang() {
        return view('guest.tentang');
    }

    public function suhu() {
        // Ambil semua data fuzzy suhu tubuh dari database
        $fuzzySuhu = \App\Models\BodyTemperatureFuzzy::all();
        return view('guest.suhu', compact('fuzzySuhu'));
    }
    public function heartRate() {
        // Ambil semua data fuzzy heart rate dari database
        $fuzzyHeartRate = \App\Models\HeartRateFuzzy::all();
        return view('guest.heartRate', compact('fuzzyHeartRate'));
    }
    public function mood() {
        // Ambil semua data fuzzy mood dari database
        $fuzzyMood = \App\Models\Mood::all();
        return view('guest.mood', compact('fuzzyMood'));
    }
    public function snack() {
        // Ambil semua mood beserta snack yang direkomendasikan untuk mood tsb (dari pivot)
        $moods = \App\Models\Mood::with(['snacks' => function($q) {
            $q->select('snacks.id', 'nama_snack', 'foto_snack', 'kandungan_gizi');
        }])->get();
        return view('guest.snack', compact('moods'));
    }
}
