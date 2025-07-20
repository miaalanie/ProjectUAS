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

    public function store2(Request $request)
    {
        $data = $request->validate([
            'suhu' => 'numeric|between:20,50',
            'detak_jantung' => 'integer|between:30,250',
        ]);

        $sensorData = SensorReading::create($data + ['recorded_at' => now()]);

        return response()->json([
            'status' => 'success',
            'data' => $sensorData
        ], 201);
    }


    /**
     * Ambil 50 data terbaru sensor (GET /api/sensor-readings)
     */
   public function index()
{
    $readings = SensorReading::latest('recorded_at')
        ->take(50)
        ->get();

    return response()->json([
        'success' => true,
        'data' => $readings
    ]);
}
    
}
