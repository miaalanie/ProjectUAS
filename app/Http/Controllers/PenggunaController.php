<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index()
    {
        $daftarPengguna = User::all();
        return view('admin.pengguna', [
            'daftarPengguna' => $daftarPengguna,
            'editMode' => false,
            'pengguna' => null
        ]);
    }

    public function edit($id)
    {
        $daftarPengguna = User::all();
        $pengguna = User::findOrFail($id);
        return view('admin.pengguna', [
            'daftarPengguna' => $daftarPengguna,
            'editMode' => true,
            'pengguna' => $pengguna
        ]);
    }

    public function update(Request $request, $id)
    {
        $pengguna = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required|in:admin,user',
            'password' => 'nullable|string|min:6',
        ]);

        $pengguna->name = $request->name;
        $pengguna->email = $request->email;
        $pengguna->role = $request->role;

        if ($request->password) {
            $pengguna->password = Hash::make($request->password);
        }

        $pengguna->save();

        return redirect()->route('admin.pengguna')->with('success', 'Biodata berhasil diperbarui!');
    }
}
