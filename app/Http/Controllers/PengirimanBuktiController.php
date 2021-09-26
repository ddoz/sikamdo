<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengirimanBuktiController extends Controller
{
    public function index() {
        return view('pengiriman_bukti');
    }
}
