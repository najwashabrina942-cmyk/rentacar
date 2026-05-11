<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mobils', function (Blueprint $table) {
            $table->string('slug')->unique()->after('id_mobil');
            $table->string('jenis')->nullable()->after('nama_mobil');
            $table->string('transmisi')->nullable()->after('jenis');
            $table->string('seat')->nullable()->after('transmisi');
            $table->string('bahan_bakar')->nullable()->after('seat');
            $table->string('gambar')->nullable()->after('deskripsi');
            $table->decimal('rating', 2, 1)->default(4.5)->after('gambar');
        });
    }

    public function down(): void
    {
        Schema::table('mobils', function (Blueprint $table) {
            $table->dropColumn([
                'slug',
                'jenis',
                'transmisi',
                'seat',
                'bahan_bakar',
                'gambar',
                'rating'
            ]);
        });
    }
};