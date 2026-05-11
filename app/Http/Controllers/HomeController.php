<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil;

class HomeController extends Controller
{
    public function index()
    {
        $mobils = Mobil::limit(4)->get();

        return view('home', compact('mobils'));
    }

    public function daftarMobil()
    {
        $query = Mobil::query();

        if (request('search')) {
            $query->where('nama_mobil', 'like', '%' . request('search') . '%');
        }

        if (request('jenis')) {
            $query->where('jenis', request('jenis'));
        }

        if (request('status')) {
            $query->where('status_mobil', request('status'));
        }

        if (request('harga') == 'termurah') {
            $query->orderBy('harga_per_hari', 'asc');
        }

        if (request('harga') == 'termahal') {
            $query->orderBy('harga_per_hari', 'desc');
        }

        $mobils = $query->take(8)->get();

        return view('daftar-mobil', compact('mobils'));
    }

    public function detailMobil($id)
    {
        $mobil = Mobil::where('id_mobil', $id)->firstOrFail();

        return view('detail-mobil', compact('mobil'));
    }

    public function dashboard()
    {
        $query = Mobil::query();

        if (request('search')) {
            $query->where(function ($q) {
                $q->where('nama_mobil', 'like', '%' . request('search') . '%')
                  ->orWhere('merk', 'like', '%' . request('search') . '%');
            });
        }

        if (request('jenis')) {
            $query->whereIn('jenis', request('jenis'));
        }

        if (request('harga')) {
            $query->where('harga_per_hari', '<=', request('harga'));
        }

        if (request('transmisi')) {
            $query->where('transmisi', request('transmisi'));
        }

        if (request('seat')) {
            $query->where('seat', request('seat'));
        }

        $mobils = $query->get();

        return view('dashboard', compact('mobils'));
    }

    public function booking($id)
    {
        $mobil = Mobil::where('id_mobil', $id)->firstOrFail();

        return view('booking', compact('mobil'));
    }
}