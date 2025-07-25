<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard() {
        return view('user.dashboard');
    }

    public function diagnosa() {
        return view('user.diagnosaBaru');
    }

    public function riwayat() {
        return view('user.riwayatDiagnosa');
    }

    public function mySnack() {
        return view('user.mySnack');
    }
    public function statistik() {
        return view('user.statistik');
    }
   

}
