<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SensorReadingController;


Route::post('/sensor-readings', [SensorReadingController::class, 'store']);
Route::get('/sensor-readings', [SensorReadingController::class, 'index']);

// Dashboard Guest API
use App\Http\Controllers\GuestController;
Route::get('/dashboard/diagnosis-per-day', [GuestController::class, 'apiDiagnosisPerDay']);
Route::get('/dashboard/mood-distribution', [GuestController::class, 'apiMoodDistribution']);


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
