<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengajuanProposalController extends Controller
{
    public function index() {
        return view('pengajuan_proposal');
    }
}
