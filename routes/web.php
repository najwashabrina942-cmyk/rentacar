<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MobilController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/daftar-mobil', [HomeController::class, 'daftarMobil'])->name('daftar.mobil');
Route::get('/detail-mobil/{slug}', [HomeController::class, 'detailMobil'])->name('detail.mobil');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');
Route::post('/booking/{slug}', [MobilController::class, 'bookingStore'])->name('booking.store');
require __DIR__.'/auth.php';