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

    public function tentang() {
        return view('guest.tentang');
    }
}
