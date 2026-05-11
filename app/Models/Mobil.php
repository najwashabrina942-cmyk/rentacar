<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    protected $primaryKey = 'id_mobil';

    protected $fillable = [
        'id_owner',
        'slug',
        'nama_mobil',
        'jenis',
        'merk',
        'plat_nomor',
        'tahun',
        'transmisi',
        'seat',
        'bahan_bakar',
        'harga_per_hari',
        'status_mobil',
        'deskripsi',
        'gambar',
        'rating'
    ];
}