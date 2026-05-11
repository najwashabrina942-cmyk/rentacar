<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil;

class MobilController extends Controller
{
    public function bookingStore(Request $request, $id)
    {
        $mobil = Mobil::where('id_mobil', $id)->firstOrFail();

        return view('booking', [
            'mobil' => $mobil,
            'mulai' => $request->tanggal_mulai,
            'selesai' => $request->tanggal_selesai,
        ]);
    }
}