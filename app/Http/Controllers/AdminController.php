<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Snack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

    // ======== CRUD SNACK ========
    public function snack()
    {
        $daftarSnack = Snack::all();
        return view('admin.snack', compact('daftarSnack'));
    }

    public function tambahSnack()
    {
        return view('admin.tambahSnack');
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

        $request->validate([
            'nama_snack' => 'required|string|max:255',
            'kandungan_gizi' => 'required|string',
            'foto_snack' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto_snack')) {
            if ($snack->foto_snack && Storage::disk('public')->exists($snack->foto_snack)) {
                Storage::disk('public')->delete($snack->foto_snack);
            }
            $fotoPath = $request->file('foto_snack')->store('snack_photos', 'public');
            $snack->foto_snack = $fotoPath;
        }

        $snack->update([
            'nama_snack' => $request->nama_snack,
            'kandungan_gizi' => $request->kandungan_gizi,
        ]);

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
