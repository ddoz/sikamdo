<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengajuanProposalController;
use App\Http\Controllers\PengirimanBuktiController;
use App\Http\Controllers\TipeMediaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [HomeController::class, 'index']);
Route::get('/tentang', [HomeController::class, 'tentang']);
Route::get('/daftar_media', [HomeController::class, 'daftar_media']);
Route::get('/faq', [HomeController::class, 'faq']);
Route::get('/bantuan', [HomeController::class, 'bantuan']);
Route::get('/survey', [HomeController::class, 'survey']);
Route::get('/signin', [HomeController::class, 'signin']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('/pengajuan_proposal', App\Http\Livewire\UserProposal::class)->middleware(['auth'])->name('pengajuan_proposal');
Route::get('/pengiriman_bukti', App\Http\Livewire\UserBuktiTayang::class)->middleware(['auth'])->name('pengiriman_bukti');
Route::middleware(['auth'])->get('/kirim_bukti_tayang/{id}', App\Http\Livewire\UserKirimBuktiTayang::class)->name('kirim_bukti_tayang');

//ADMIN
Route::middleware(['admin'])->get('/tipe_media', App\Http\Livewire\Tipemedias::class)->name('tipe_media');
Route::middleware(['admin'])->get('/proposal', App\Http\Livewire\AdminProposal::class)->name('proposal');
Route::middleware(['admin'])->get('/formulir_buktitayang/{id}', App\Http\Livewire\FormulirBuktiTayangs::class)->name('formulir_buktitayang');
Route::middleware(['admin'])->get('/bukti_tayang/{id}', App\Http\Livewire\AdminBuktiTayang::class)->name('bukti_tayang');
Route::middleware(['admin'])->get('/pengiriman', App\Http\Livewire\Tipemedias::class)->name('pengiriman');
Route::middleware(['admin'])->get('/users', App\Http\Livewire\Users::class)->name('users');
Route::middleware(['admin'])->get('/jadwal', App\Http\Livewire\AdminJadwal::class)->name('jadwal');

require __DIR__.'/auth.php';
