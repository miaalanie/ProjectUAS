<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Snack;
use App\Models\Mood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // ======== CRUD PENGGUNA ========
    public function pengguna()
    {
        $daftarPengguna = User::all();
        return view('admin.pengguna', compact('daftarPengguna'));
    }

    public function tambahPengguna()
    {
        return view('admin.tambahPengguna');
    }

    public function simpanPengguna(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,user',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.pengguna')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    public function editPengguna($id)
    {
        $pengguna = User::findOrFail($id);
        return view('admin.editPengguna', compact('pengguna'));
    }

    public function updatePengguna(Request $request, $id)
    {
        $pengguna = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$pengguna->id,
            'role' => 'required|in:admin,user',
            'password' => 'nullable|string|min:6',
        ]);

        $pengguna->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $request->password ? Hash::make($request->password) : $pengguna->password,
        ]);

        return redirect()->route('admin.pengguna')->with('success', 'Pengguna berhasil diperbarui!');
    }

    public function hapusPengguna($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.pengguna')->with('success', 'Pengguna berhasil dihapus!');
    }

        // ======== LOG MOOD ========
     public function logMood()
{
    // Ambil data mood per hari
    $moodPerHari = Mood::select(DB::raw('DATE(created_at) as tanggal'), DB::raw('COUNT(*) as jumlah'))
        ->groupBy('tanggal')
        ->orderBy('tanggal', 'ASC')
        ->get();

    // Ambil data mood per minggu
    $moodPerMinggu = Mood::select(DB::raw('YEARWEEK(created_at) as minggu'), DB::raw('COUNT(*) as jumlah'))
        ->groupBy('minggu')
        ->orderBy('minggu', 'ASC')
        ->get();

    // Ambil data mood per bulan
    $moodPerBulan = Mood::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as bulan'), DB::raw('COUNT(*) as jumlah'))
        ->groupBy('bulan')
        ->orderBy('bulan', 'ASC')
        ->get();

    return view('admin.logMood', compact('moodPerHari', 'moodPerMinggu', 'moodPerBulan'));
}

    // riwayat snack
    public function riwayatSnack()
{
    // Data perhari
    $harian = DB::table('riwayat_snacks')
        ->select(DB::raw('DATE(created_at) as tanggal, COUNT(*) as jumlah'))
        ->whereDate('created_at', today())
        ->groupBy('tanggal')
        ->get();

    // Data perminggu
    $mingguan = DB::table('riwayat_snacks')
        ->select(DB::raw('WEEK(created_at) as minggu, COUNT(*) as jumlah'))
        ->whereBetween('created_at', [now()->subWeek(), now()])
        ->groupBy('minggu')
        ->get();

    // Data perbulan
    $bulanan = DB::table('riwayat_snacks')
        ->select(DB::raw('MONTH(created_at) as bulan, COUNT(*) as jumlah'))
        ->whereYear('created_at', now()->year)
        ->groupBy('bulan')
        ->get();

    return view('admin.riwayatSnack', compact('harian', 'mingguan', 'bulanan'));
}

    // statistik konsumsi
    public function statistikKonsumsi()
{
    // Data per kategori per hari
    $harian = DB::table('riwayat_snacks')
        ->select(DB::raw('DATE(created_at) as tanggal, kategori, COUNT(*) as jumlah'))
        ->join('snacks', 'riwayat_snacks.snack_id', '=', 'snacks.id')
        ->groupBy('tanggal', 'kategori')
        ->orderBy('tanggal')
        ->get();

    // Data per kategori per minggu
    $mingguan = DB::table('riwayat_snacks')
        ->select(DB::raw('YEARWEEK(created_at) as minggu, kategori, COUNT(*) as jumlah'))
        ->join('snacks', 'riwayat_snacks.snack_id', '=', 'snacks.id')
        ->groupBy('minggu', 'kategori')
        ->orderBy('minggu')
        ->get();

    // Data per kategori per bulan
    $bulanan = DB::table('riwayat_snacks')
        ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as bulan, kategori, COUNT(*) as jumlah'))
        ->join('snacks', 'riwayat_snacks.snack_id', '=', 'snacks.id')
        ->groupBy('bulan', 'kategori')
        ->orderBy('bulan')
        ->get();

    return view('admin.statistikKonsumsi', compact('harian', 'mingguan', 'bulanan'));
}

    // bad mood
   public function badMood()
{
    $badMoodData = DB::table('moods')
        ->select(DB::raw('DATE(created_at) as tanggal'), DB::raw('COUNT(*) as jumlah'))
        ->where('status', 'bad') // pastikan kolom mood atau status bad mood
        ->groupBy('tanggal')
        ->orderBy('tanggal')
        ->get();

    return view('admin.badMood', compact('badMoodData'));
}

    // frekuensi snack
    public function frekuensiSnack()
    {
        return view('admin.frekuensiSnack'); // konsisten dengan nama file
    }

    // ======== CRUD SNACK ========
    public function snack()
    {
        $daftarSnack = Snack::all();
        return view('admin.snack', compact('daftarSnack'));
    }

    public function tambahSnack()
    {
        return view('admin.snack_tambah');
    }

    public function simpanSnack(Request $request)
    {
        $request->validate([
            'nama_snack' => 'required|string|max:255',
            'kandungan_gizi' => 'required|string',
            'foto_snack' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto_snack')) {
            $fotoPath = $request->file('foto_snack')->store('snack_photos', 'public');
        }

        Snack::create([
            'nama_snack' => $request->nama_snack,
            'kandungan_gizi' => $request->kandungan_gizi,
            'foto_snack' => $fotoPath,
        ]);

        return redirect()->route('admin.snack')->with('success', 'Snack berhasil ditambahkan!');
    }

    public function editSnack($id)
    {
        $snack = Snack::findOrFail($id);
        return view('admin.editSnack', compact('snack'));
    }

 public function updateSnack(Request $request, $id)
{
    $snack = Snack::findOrFail($id);

    $validated = $request->validate([
        'nama_snack'     => 'required|string|max:255',
        'kandungan_gizi' => 'required|string',
        'foto_snack'     => 'nullable|image|mimes:jpg,jpeg,png',
    ]);

    if ($request->hasFile('foto_snack')) {
        // hapus foto lama
        if ($snack->foto_snack && Storage::disk('public')->exists($snack->foto_snack)) {
            Storage::disk('public')->delete($snack->foto_snack);
        }

        $file = $request->file('foto_snack');
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('snack_photos', $filename, 'public'); // ke storage/app/public/snack_photos
        $validated['foto_snack'] = $path; // path relatif di DB
    }

    $snack->update($validated);

    return redirect()->route('admin.snack')->with('success', 'Snack berhasil diperbarui!');
}

    public function hapusSnack($id)
    {
        $snack = Snack::findOrFail($id);
        if ($snack->foto_snack && Storage::disk('public')->exists($snack->foto_snack)) {
            Storage::disk('public')->delete($snack->foto_snack);
        }
        $snack->delete();

        return redirect()->route('admin.snack')->with('success', 'Snack berhasil dihapus!');
    }
}
