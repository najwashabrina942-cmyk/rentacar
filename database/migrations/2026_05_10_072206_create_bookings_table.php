<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('id_booking');

            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_mobil');

            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->decimal('total_harga', 12, 2);

            $table->enum('status_booking', [
                'menunggu',
                'disetujui',
                'ditolak',
                'selesai',
                'dibatalkan'
            ])->default('menunggu');

            $table->timestamps();

            $table->foreign('id_user')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('id_mobil')
                ->references('id_mobil')
                ->on('mobils')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};