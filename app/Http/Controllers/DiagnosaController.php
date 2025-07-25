<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\SummaryPdfMail;

class diagnosaController extends Controller
{

public function summary($user_id)
{
    $guest = Guest::find($user_id);

    if (!$guest) {
        abort(404, 'Guest tidak ditemukan');
    }

    $diagnosis = Diagnosis::with('snack')
        ->where('user_id', $user_id)
        ->orderByDesc('id') // aman kalau nggak punya created_at
        ->first();
    // dd($guest, $diagnosis);

    return view('guest.summary', compact('guest', 'diagnosis'));
}

public function sendEmail(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'user_id' => 'required|integer'
    ]);

    $guest = Guest::find($request->user_id);
    $diagnosis = Diagnosis::with('snack')
        ->where('user_id', $request->user_id)
        ->latest()
        ->first();

    if (!$guest || !$diagnosis) {
        return response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan'], 404);
    }   

    // Generate PDF dari view summary
    $pdf = Pdf::loadView('emails.summary-pdf', [
        'guest' => $guest,
        'diagnosis' => $diagnosis
    ]);

    // Kirim email
    Mail::to($request->email)->send(new SummaryPdfMail($guest, $diagnosis, $pdf));

    return response()->json(['status' => 'success', 'message' => 'Summary berhasil dikirim ke email']);
}

}
