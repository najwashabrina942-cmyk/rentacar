<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MobilSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->updateOrInsert(
            ['id' => 1],
            [
                'name' => 'Owner Rental',
                'email' => 'owner@gmail.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        $mobils = [
            ['slug' => 'toyota-innova-reborn', 'nama_mobil' => 'Toyota Innova Reborn', 'jenis' => 'MPV', 'merk' => 'Toyota', 'plat_nomor' => 'BK 1001 AA', 'tahun' => 2024, 'transmisi' => 'Matic', 'seat' => '7 seater', 'bahan_bakar' => 'Diesel', 'harga_per_hari' => 650000, 'status_mobil' => 'tersedia', 'deskripsi' => 'Mobil nyaman untuk keluarga dan perjalanan dinas.', 'gambar' => 'innova.jpg', 'rating' => 4.9],
            ['slug' => 'honda-civic-type-r', 'nama_mobil' => 'Honda Civic Type R', 'jenis' => 'Sport', 'merk' => 'Honda', 'plat_nomor' => 'BK 1002 BB', 'tahun' => 2023, 'transmisi' => 'Manual', 'seat' => '4 seater', 'bahan_bakar' => 'Bensin', 'harga_per_hari' => 1250000, 'status_mobil' => 'disewa', 'deskripsi' => 'Mobil sport dengan performa tinggi.', 'gambar' => 'civic.jpg', 'rating' => 4.9],
            ['slug' => 'mitsubishi-pajero-sport', 'nama_mobil' => 'Mitsubishi Pajero Sport', 'jenis' => 'SUV', 'merk' => 'Mitsubishi', 'plat_nomor' => 'BK 1003 CC', 'tahun' => 2023, 'transmisi' => 'Matic', 'seat' => '7 seater', 'bahan_bakar' => 'Diesel', 'harga_per_hari' => 850000, 'status_mobil' => 'tersedia', 'deskripsi' => 'SUV gagah untuk perjalanan keluarga dan luar kota.', 'gambar' => 'pajero.jpg', 'rating' => 4.7],
            ['slug' => 'daihatsu-xenia-x', 'nama_mobil' => 'Daihatsu Xenia X', 'jenis' => 'MPV', 'merk' => 'Daihatsu', 'plat_nomor' => 'BK 1004 DD', 'tahun' => 2022, 'transmisi' => 'Manual', 'seat' => '7 seater', 'bahan_bakar' => 'Bensin', 'harga_per_hari' => 280000, 'status_mobil' => 'tersedia', 'deskripsi' => 'Mobil keluarga yang irit dan mudah digunakan.', 'gambar' => 'xenia.jpg', 'rating' => 4.6],
            ['slug' => 'toyota-calya-g', 'nama_mobil' => 'Toyota Calya G', 'jenis' => 'MPV', 'merk' => 'Toyota', 'plat_nomor' => 'BK 1005 EE', 'tahun' => 2022, 'transmisi' => 'Manual', 'seat' => '7 seater', 'bahan_bakar' => 'Bensin', 'harga_per_hari' => 250000, 'status_mobil' => 'tersedia', 'deskripsi' => 'Mobil keluarga ekonomis dan nyaman.', 'gambar' => 'calya.jpg', 'rating' => 4.6],
            ['slug' => 'honda-jazz-rs', 'nama_mobil' => 'Honda Jazz RS', 'jenis' => 'Hatchback', 'merk' => 'Honda', 'plat_nomor' => 'BK 1006 FF', 'tahun' => 2021, 'transmisi' => 'Matic', 'seat' => '4 seater', 'bahan_bakar' => 'Bensin', 'harga_per_hari' => 400000, 'status_mobil' => 'tersedia', 'deskripsi' => 'Mobil stylish dan nyaman untuk perkotaan.', 'gambar' => 'jazz.jpg', 'rating' => 4.7],
            ['slug' => 'toyota-rush-trd', 'nama_mobil' => 'Toyota Rush TRD', 'jenis' => 'SUV', 'merk' => 'Toyota', 'plat_nomor' => 'BK 1007 GG', 'tahun' => 2023, 'transmisi' => 'Matic', 'seat' => '7 seater', 'bahan_bakar' => 'Bensin', 'harga_per_hari' => 500000, 'status_mobil' => 'disewa', 'deskripsi' => 'SUV sporty cocok untuk perjalanan jauh.', 'gambar' => 'rush.jpg', 'rating' => 4.8],
            ['slug' => 'daihatsu-terios-r', 'nama_mobil' => 'Daihatsu Terios R', 'jenis' => 'SUV', 'merk' => 'Daihatsu', 'plat_nomor' => 'BK 1008 HH', 'tahun' => 2022, 'transmisi' => 'Manual', 'seat' => '7 seater', 'bahan_bakar' => 'Bensin', 'harga_per_hari' => 450000, 'status_mobil' => 'tersedia', 'deskripsi' => 'Mobil SUV tangguh dan nyaman.', 'gambar' => 'terios.jpg', 'rating' => 4.6],
        ];

        foreach ($mobils as $mobil) {
            DB::table('mobils')->updateOrInsert(
                ['slug' => $mobil['slug']],
                array_merge($mobil, [
                    'id_owner' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}