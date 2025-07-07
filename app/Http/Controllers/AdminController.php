<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard() {
        return view('admin.dashboard');
    }

    public function pengguna() {
        return view('admin.pengguna');
    }

    public function snack() {
        return view('admin.snack');
    }

    public function rules() {
        return view('admin.rules');
    }

    public function logMood() {
        return view('admin.logMood');
    }

    public function riwayatSnack() {
        return view('admin.riwayatSnack');
    }

    public function statistikKonsumsi() {
        return view('admin.statistikKonsumsi');
    }

    public function badMood() {
        return view('admin.badMood');
    }

    public function frekuensiSnack() {
        return view('admin.frekuensiSnack');
    }

    public function laporanUser() {
        return view('admin.laporanUser');
    }

    public function laporanAkumulasi() {
        return view('admin.laporanAkumulasi');
    }
}
