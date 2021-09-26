<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function index() {
        return view('home',['link'=>'beranda']);
    }

    public function tentang() {
        return view('tentang',['link'=>'tentang']);
    }

    public function daftar_media() {
        return view('daftar_media',['link'=>'daftar']);
    }

    public function faq() {
        return view('faq',['link'=>'faq']);
    }

    public function bantuan() {
        return view('bantuan',['link'=>'bantuan']);
    }

    public function survey() {
        return view('survey',['link'=>'survey']);
    }

    public function signin() {
        return view('signin',['link'=>'signin']);
    }
}
