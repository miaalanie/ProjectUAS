<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensorReading;
use Illuminate\Support\Facades\Validator;

class SensorReadingController extends Controller
{
    /**
     * Simpan data sensor (POST /api/sensor-readings)
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'suhu' => 'required|numeric|between:20,45',
            'detak_jantung' => 'required|integer|between:30,180',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Simpan data sensor
        $reading = SensorReading::create([
            'user_id' => $request->user_id,
            'suhu' => $request->suhu,
            'detak_jantung' => $request->detak_jantung,
            'recorded_at' => now(), // pakai waktu sekarang
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Sensor reading saved successfully.',
            'data' => $reading
        ], 201);
    }

    /**
     * Ambil 50 data terbaru sensor (GET /api/sensor-readings)
     */
    public function index()
    {
        $readings = SensorReading::with('user')
            ->latest('recorded_at')
            ->take(50)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $readings
        ]);
    }
}
