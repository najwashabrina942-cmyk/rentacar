<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MobilController;

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/daftar-mobil', [HomeController::class, 'daftarMobil'])
    ->name('daftar.mobil');

Route::get('/mobil/{id}', [HomeController::class, 'detailMobil'])
    ->name('detail.mobil');

Route::get('/dashboard', [HomeController::class, 'dashboard'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('/booking/{id}', function ($id) {

    $mobil = \App\Models\Mobil::where('id_mobil', $id)->firstOrFail();

    return view('booking', [

        'mobil' => $mobil,

        'mulai' => request('mulai')
            ? request('mulai') . 'T09:00'
            : null,

        'selesai' => request('selesai')
            ? request('selesai') . 'T09:00'
            : null,

    ]);

})->name('booking');

Route::post('/booking/{id}', [MobilController::class, 'bookingStore'])
    ->name('booking.store');

require __DIR__.'/auth.php';